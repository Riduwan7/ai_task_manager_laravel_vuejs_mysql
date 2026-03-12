<?php

namespace App\Jobs;

use App\Models\Task;
use App\Services\AIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAITaskSummary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Task $task;

    /**
     * Create job instance
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job
     */
    public function handle(AIService $aiService): void
    {
        $aiData = $aiService->generateSummary($this->task);

        $this->task->update($aiData);
    }
}