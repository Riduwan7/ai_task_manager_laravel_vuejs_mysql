<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Jobs\ProcessAITaskSummary;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;
    protected AIService $aiService;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        AIService $aiService
    ) {
        $this->taskRepository = $taskRepository;
        $this->aiService = $aiService;
    }

    /**
     * Get all tasks
     */
    public function getAllTasks(array $filters = [])
    {
        return $this->taskRepository->all($filters);
    }

    /**
     * Get single task
     */
    public function getTask(int $id)
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Create task + AI processing
     */
    public function createTask(array $data)
    {
        $task = $this->taskRepository->create($data);

        // dispatch AI job
        ProcessAITaskSummary::dispatch($task);

        return $task;
    }


    /**
     * Update task
     */
    public function updateTask(int $id, array $data): Task
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * Delete task
     */
    public function deleteTask(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }

    /**
     * Update task status
     */
    public function updateStatus(int $id, string $status): Task
    {
        return $this->taskRepository->updateStatus($id, $status);
    }

    /**
     * Get AI summary for task
     */
    public function generateAISummary(int $taskId)
    {
        $task = $this->taskRepository->find($taskId);

        $aiData = $this->aiService->generateSummary($task);

        $this->taskRepository->update($task->id, $aiData);

        return $task->refresh();
    }

    /**
     * Dashboard statistics
     */
    public function getDashboardStats(): array
    {
        return $this->taskRepository->getStatistics();
    }
}
