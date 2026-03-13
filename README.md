# AI Task Management System

A production-ready Task Management System using Laravel 11. It features a clean architecture, Repository Pattern, and AI integration for automated task summaries and priority analysis.

## Features
- **Clean Architecture:** Uses Repositories and Services to keep controllers thin.
- **AI Integration:** Automatically processes task summaries using an AI Service (Queued Job).
- **Authentication:** Role-based access (Admin/User).
- **Tailwind CSS UI:** Styled components matching the requested UI details.
- **Docker Support:** Ready to run via Laravel Sail.
- **Automated Tests:** Feature tests added for critical Task workflows.

## Architecture

The application adheres to clean architecture principles:
1. **Controllers:** Only handle HTTP requests, responses, and validation layers.
2. **Services (`App\Services`):** The business logic layer. Handles transactions, triggers external APIs, and calls Repositories.
3. **Repositories (`App\Repositories`):** The data access layer. Abstracts Eloquent queries following the `TaskRepositoryInterface`. Controllers cannot make direct Eloquent calls.
4. **Policies (`App\Policies`):** Handles authorization rules (e.g., users can only view/edit tasks assigned to them).
5. **Enums (`App\Enums`):** Strongly typed definition for Priorities and Statuses.

## AI Implementation details

The AI is integrated via background queues to prevent slowing down the HTTP request during task creation.

**Flow:**
1. A new Task is created.
2. The `ProcessAITaskSummary` Job is dispatched to the background queue.
3. Once the queue worker processes the job, the `AIService` parses the task data and triggers the selected LLM provider API (OpenAI / Gemini / Claude) based on configurations with a fallback mock service.
4. The requested Prompt is:
   ```text
   Analyze the following task and provide:
   1. Short summary (1 sentence)
   2. Priority level (low, medium, high)

   Task Title: {task_title}
   Task Description: {task_description}

   Response format JSON:
   {
       "summary": "string",
       "priority": "low|medium|high"
   }
   ```
5. The `AIService` parses the JSON response, validates it, and updates `ai_summary` and `ai_priority` on the Task model.

## Setup Instructions

### Docker Setup

1. Copy `.env.example` to `.env` and set DB details and AI keys.
2. Run Laravel sail via Docker:
```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### Local Setup

1. Copy `.env.example` to `.env`
2. Run `composer install`
3. Run `npm install && npm run build`
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `php artisan serve` and `php artisan queue:work` to parse async AI task summaries.

### Testing

Run the feature tests via artisan or Sail:
```bash
php artisan test
```
