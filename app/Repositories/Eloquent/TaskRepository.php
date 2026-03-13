<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Get all tasks with filters
     */
    public function all(array $filters = [])
    {
        $cacheKey = 'tasks.all.' . md5(serialize($filters) . request('page', 1));

        return \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addMinutes(5), function () use ($filters) {
            return Task::query()
                ->with('user')
                ->filter($filters)
                ->latest()
                ->paginate(10);
        });
    }

    /**
     * Find task
     */
    public function find(int $id): ?Task
    {
        return \Illuminate\Support\Facades\Cache::remember("tasks.{$id}", now()->addMinutes(5), function () use ($id) {
            return Task::query()->with('user')->findOrFail($id);
        });
    }

    /**
     * Create task
     */
    public function create(array $data): Task
    {
        // Cast assigned_to to integer if present (comes as string from form)
        if (isset($data['assigned_to'])) {
            $data['assigned_to'] = (int) $data['assigned_to'];
        }

        // Cast due_date properly — Eloquent date cast needs Carbon or null
        if (isset($data['due_date']) && $data['due_date'] !== '') {
            $data['due_date'] = \Carbon\Carbon::parse($data['due_date'])->toDateString();
        } else {
            $data['due_date'] = null;
        }

        // Remove dd() debug and do the create inside try-catch to expose real error
        try {
            $task = Task::query()->create($data);
            \Illuminate\Support\Facades\Cache::forget('tasks.stats');
            return $task;
        } catch (\Exception $e) {
            \Log::error('Task::create failed', [
                'data'    => $data,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Update task
     */
    public function update(int $id, array $data): Task
    {
        $task = Task::query()->findOrFail($id);

        // Defensive: unwrap any enum instances to their scalar values
        if (isset($data['priority']) && $data['priority'] instanceof \BackedEnum) {
            $data['priority'] = $data['priority']->value;
        }

        if (isset($data['status']) && $data['status'] instanceof \BackedEnum) {
            $data['status'] = $data['status']->value;
        }

        $task->update($data);

        \Illuminate\Support\Facades\Cache::forget("tasks.{$id}");
        \Illuminate\Support\Facades\Cache::forget('tasks.stats');

        return $task;
    }

    /**
     * Delete task (soft delete)
     */
    public function delete(int $id): bool
    {
        $task = Task::findOrFail($id);

        $deleted = $task->delete();

        if ($deleted) {
            \Illuminate\Support\Facades\Cache::forget("tasks.{$id}");
            \Illuminate\Support\Facades\Cache::forget('tasks.stats');
        }

        return $deleted;
    }

    /**
     * Update task status
     */
    public function updateStatus(int $id, string $status): Task
    {
        $task = Task::query()->findOrFail($id);

        // Unwrap enum if passed as instance
        if ($status instanceof \BackedEnum) {
            $status = $status->value;
        }

        $task->update([
            'status' => $status
        ]);

        \Illuminate\Support\Facades\Cache::forget("tasks.{$id}");
        \Illuminate\Support\Facades\Cache::forget('tasks.stats');

        return $task;
    }

    /**
     * Dashboard statistics
     */
    public function getStatistics(): array
    {
        return \Illuminate\Support\Facades\Cache::remember('tasks.stats', now()->addMinutes(5), function () {
            return [
                'total_tasks'       => Task::query()->count(),
                'completed_tasks'   => Task::query()->where('status', TaskStatus::COMPLETED->value)->count(),
                'pending_tasks'     => Task::query()->where('status', TaskStatus::PENDING->value)->count(),
                'high_priority_tasks' => Task::query()->where('priority', TaskPriority::HIGH->value)->count(),
            ];
        });
    }
}
