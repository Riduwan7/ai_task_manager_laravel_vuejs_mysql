<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by RouteServiceProvider and automatically
| prefixed with /api
|
*/

Route::middleware('auth:sanctum')->group(function () {

    // Get all tasks
    Route::get('/tasks', [TaskController::class, 'index']);

    // Create task
    Route::post('/tasks', [TaskController::class, 'store']);

    // Update task status
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus']);

    // Generate AI summary
    Route::get('/tasks/{id}/ai-summary', [TaskController::class, 'aiSummary']);

});