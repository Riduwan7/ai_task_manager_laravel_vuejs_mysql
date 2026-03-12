<?php

namespace App\Repositories\Contracts;

use App\Models\Task;

interface TaskRepositoryInterface
{
    /**
     * Get all tasks
     */
    public function all(array $filters = []);

    /**
     * Find task by id
     */
    public function find(int $id): ?Task;

    /**
     * Create task
     */
    public function create(array $data): Task;

    /**
     * Update task
     */
    public function update(int $id, array $data): Task;

    /**
     * Delete task
     */
    public function delete(int $id): bool;

    /**
     * Update task status
     */
    public function updateStatus(int $id, string $status): Task;

    /**
     * Get dashboard stats
     */
    public function getStatistics(): array;
}