<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Task Pages
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Task List Page
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    // Create Task Page
    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    // Store Task
    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    // Task Details
    Route::get('/tasks/{id}', [TaskController::class, 'show'])
        ->name('tasks.show');

    // Edit Task
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    // Update Task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])
        ->name('tasks.update');

    // Delete Task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    // Update Task Status
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.status');

    // AI Summary
    Route::get('/tasks/{id}/ai-summary', [TaskController::class, 'aiSummary'])
        ->name('tasks.ai.summary');
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';