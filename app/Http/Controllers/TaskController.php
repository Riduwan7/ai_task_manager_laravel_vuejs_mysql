<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;

        $this->middleware('auth');
    }

    /**
     * List tasks
     */
    public function index(Request $request)
    {
        $filters = $request->only(['status', 'priority', 'assigned_to']);

        $tasks = $this->taskService->getAllTasks($filters);

        return TaskResource::collection($tasks);
    }

    /**
     * Create task
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        return new TaskResource($task);
    }

    /**
     * Show task
     */
    public function show(int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('view', $task);

        return new TaskResource($task);
    }

    /**
     * Update task
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('update', $task);

        $task = $this->taskService->updateTask($id, $request->validated());

        return new TaskResource($task);
    }

    /**
     * Delete task
     */
    public function destroy(int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('delete', $task);

        $this->taskService->deleteTask($id);

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }

    /**
     * Update task status
     */
    public function updateStatus(UpdateTaskStatusRequest $request, int $id)
    {
        $task = $this->taskService->updateStatus(
            $id,
            $request->status
        );

        return new TaskResource($task);
    }

    /**
     * Generate AI summary
     */
    public function aiSummary(int $id)
    {
        $task = $this->taskService->generateAISummary($id);

        return new TaskResource($task);
    }
}