<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\User;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * List tasks
     */
    public function index(Request $request)
    {
        $filters = $request->only(['status', 'priority', 'assigned_to']);

        $tasks = $this->taskService->getAllTasks($filters);

        $users = User::all();
        $stats = $this->taskService->getDashboardStats();

        return view('tasks.index', compact('tasks', 'users', 'stats'));
    }

    /**
     * Show create task form
     */
    public function create()
    {
        $users = User::all();
        $stats = $this->taskService->getDashboardStats();

        return view('tasks.create', compact('users', 'stats'));
    }

    /**
     * Create task
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        if ($request->expectsJson()) {
            return new TaskResource($task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show task
     */
    public function show(int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('view', $task);

        $stats = $this->taskService->getDashboardStats();

        return view('tasks.show', compact('task', 'stats'));
    }

    /**
     * Show edit task form
     */
    public function edit(int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('update', $task);

        $users = User::all();
        $stats = $this->taskService->getDashboardStats();

        return view('tasks.edit', compact('task', 'users', 'stats'));
    }

    /**
     * Update task
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorize('update', $task);

        $task = $this->taskService->updateTask($id, $request->validated());

        if ($request->expectsJson()) {
            return new TaskResource($task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Delete task
     */
    public function destroy(Request $request, int $id)
    {
        $this->taskService->deleteTask($id);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Task deleted successfully'
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
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

        if ($request->expectsJson()) {
            return new TaskResource($task);
        }

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Generate AI summary
     */
    public function aiSummary(int $id)
    {
        $task = $this->taskService->generateAISummary($id);

        if (request()->expectsJson()) {
            return new TaskResource($task);
        }

        return redirect()->route('tasks.show', $id)->with('success', 'AI Summary generated successfully.');
    }
}
