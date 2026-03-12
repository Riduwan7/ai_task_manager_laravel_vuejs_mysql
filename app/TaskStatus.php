<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    /**
     * Get readable label
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }

    /**
     * Get Tailwind color class
     */
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'text-gray-600',
            self::IN_PROGRESS => 'text-blue-600',
            self::COMPLETED => 'text-green-600',
        };
    }

    /**
     * Badge color for UI
     */
    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'bg-gray-100 text-gray-700',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-700',
            self::COMPLETED => 'bg-green-100 text-green-700',
        };
    }

    /**
     * Check if task is completed
     */
    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    /**
     * Dropdown options
     */
    public static function options(): array
    {
        return [
            self::PENDING->value => 'Pending',
            self::IN_PROGRESS->value => 'In Progress',
            self::COMPLETED->value => 'Completed',
        ];
    }

    /**
     * Default status
     */
    public static function default(): self
    {
        return self::PENDING;
    }
}