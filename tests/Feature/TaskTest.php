<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessAITaskSummary;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['is_admin' => true]);
        $this->user = User::factory()->create(['is_admin' => false]);
    }

    public function test_user_can_view_tasks_list()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
    }

    public function test_user_can_create_task()
    {
        Queue::fake();

        $this->actingAs($this->user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'priority' => TaskPriority::HIGH->value,
            'due_date' => now()->addDays(2)->format('Y-m-d'),
            'assigned_to' => $this->user->id,
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'assigned_to' => $this->user->id,
        ]);

        Queue::assertPushed(ProcessAITaskSummary::class);
    }

    public function test_user_can_edit_task()
    {
        $this->actingAs($this->admin);

        $task = Task::factory()->create([
            'assigned_to' => $this->user->id,
            'status' => TaskStatus::PENDING->value,
        ]);

        $updateData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated description.',
            'priority' => TaskPriority::LOW->value,
            'status' => TaskStatus::IN_PROGRESS->value,
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'assigned_to' => $this->user->id,
        ];

        $response = $this->put(route('tasks.update', $task->id), $updateData);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task Title',
            'status' => TaskStatus::IN_PROGRESS->value,
        ]);
    }

    public function test_user_can_delete_task()
    {
        $this->actingAs($this->admin);

        $task = Task::factory()->create([
            'assigned_to' => $this->user->id,
        ]);

        $response = $this->delete(route('tasks.destroy', $task->id));

        $response->assertRedirect(route('tasks.index'));
        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
    }
}
