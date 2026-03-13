<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected string $provider;

    public function __construct()
    {
        $this->provider = config('services.ai.provider', 'mock');
    }

    /**
     * Generate AI summary
     */
    public function generateSummary(Task $task): array
    {
        try {

            if ($this->provider === 'openai') {
                return $this->callOpenAI($task);
            }

            if ($this->provider === 'gemini') {
                return $this->callGemini($task);
            }

            if ($this->provider === 'claude') {
                return $this->callClaude($task);
            }

            return $this->mockResponse($task);

        } catch (\Exception $e) {

            Log::error('AI generation failed', [
                'error' => $e->getMessage()
            ]);

            return $this->mockResponse($task);
        }
    }

    /**
     * Create AI prompt
     */
    protected function buildPrompt(Task $task): string
    {
        return "
            You are an AI task assistant.

            Analyze the following task and return ONLY valid JSON.

            Task Title: {$task->title}

            Task Description:
            {$task->description}

            Return JSON with the following format:

            {
            \"summary\": \"short one sentence summary\",
            \"priority\": \"low | medium | high\"
            }

            Rules:
            - Only return JSON
            - Do not include explanation
            - Do not include markdown
        ";
    }

    /**
     * OpenAI integration
     */
    protected function callOpenAI(Task $task): array
    {
        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/chat/completions', [

                'model' => 'gpt-4o-mini',

                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->buildPrompt($task)
                    ]
                ]

            ]);

        $content = $response['choices'][0]['message']['content'];

        return $this->parseResponse($content);
    }

    /**
     * Gemini integration
     */
    protected function callGemini(Task $task): array
    {
        $response = Http::post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.key'),
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $this->buildPrompt($task)]
                        ]
                    ]
                ]
            ]
        );

        $content = $response['candidates'][0]['content']['parts'][0]['text'];

        return $this->parseResponse($content);
    }

    /**
     * Claude integration
     */
    protected function callClaude(Task $task): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.claude.key'),
            'anthropic-version' => '2023-06-01'
        ])->post('https://api.anthropic.com/v1/messages', [

            'model' => 'claude-3-sonnet',

            'messages' => [
                [
                    'role' => 'user',
                    'content' => $this->buildPrompt($task)
                ]
            ],

            'max_tokens' => 200
        ]);

        $content = $response['content'][0]['text'];

        return $this->parseResponse($content);
    }

    /**
     * Parse AI response
     */
    protected function parseResponse(string $content): array
    {
        $data = json_decode($content, true);

        return [
            'ai_summary' => $data['summary'] ?? 'AI summary not available',
            'ai_priority' => $data['priority'] ?? 'medium'
        ];
    }

    /**
     * Mock fallback
     */
    protected function mockResponse(Task $task): array
    {
        $priority = 'medium';

        if (str_contains(strtolower($task->description), 'urgent')) {
            $priority = 'high';
        }

        return [
            'ai_summary' => "Task related to: {$task->title}",
            'ai_priority' => $priority
        ];
    }
}