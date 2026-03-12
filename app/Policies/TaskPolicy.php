<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    /**
     * View task
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to || $user->is_admin;
    }

    /**
     * Update task
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to || $user->is_admin;
    }

    /**
     * Delete task
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->is_admin;
    }
}