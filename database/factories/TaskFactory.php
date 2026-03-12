<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->randomElement(['low','medium','high']),
            'status' => $this->faker->randomElement(['pending','in_progress','completed']),
            'due_date' => $this->faker->date(),
            'ai_summary' => null,
            'ai_priority' => null
        ];
    }
}