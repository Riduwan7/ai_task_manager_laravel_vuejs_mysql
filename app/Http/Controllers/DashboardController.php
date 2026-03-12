<?php

namespace App\Http\Controllers;

use App\Services\TaskService;

class DashboardController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Dashboard page
     */
    public function index()
    {
        $stats = $this->taskService->getDashboardStats();

        return view('dashboard.index', compact('stats'));
    }
}