<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Get all tasks with filters
     */
    public function all(array $filters = [])
    {
        return Task::query()
            ->with('user')
            ->filter($filters)
            ->latest()
            ->paginate(10);
    }

    /**
     * Find task
     */
    public function find(int $id): ?Task
    {
        return Task::with('user')->findOrFail($id);
    }

    /**
     * Create task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * Update task
     */
    public function update(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);

        $task->update($data);

        return $task;
    }

    /**
     * Delete task (soft delete)
     */
    public function delete(int $id): bool
    {
        $task = Task::findOrFail($id);

        return $task->delete();
    }

    /**
     * Update task status
     */
    public function updateStatus(int $id, string $status): Task
    {
        $task = Task::findOrFail($id);

        $task->update([
            'status' => $status
        ]);

        return $task;
    }

    /**
     * Dashboard statistics
     */
    public function getStatistics(): array
    {
        return [
            'total_tasks' => Task::count(),
            'completed_tasks' => Task::where('status', 'completed')->count(),
            'pending_tasks' => Task::where('status', 'pending')->count(),
            'high_priority_tasks' => Task::where('priority', 'high')->count(),
        ];
    }
}