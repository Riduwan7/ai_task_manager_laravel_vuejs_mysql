<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    /**
     * Get readable label
     */
    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    /**
     * Get Tailwind color class
     */
    public function color(): string
    {
        return match ($this) {
            self::LOW => 'text-green-600',
            self::MEDIUM => 'text-yellow-600',
            self::HIGH => 'text-red-600',
        };
    }

    /**
     * Get background badge color
     */
    public function badge(): string
    {
        return match ($this) {
            self::LOW => 'bg-green-100 text-green-700',
            self::MEDIUM => 'bg-yellow-100 text-yellow-700',
            self::HIGH => 'bg-red-100 text-red-700',
        };
    }

    /**
     * Get all values for dropdown
     */
    public static function options(): array
    {
        return [
            self::LOW->value => 'Low',
            self::MEDIUM->value => 'Medium',
            self::HIGH->value => 'High',
        ];
    }

    /**
     * Default priority
     */
    public static function default(): self
    {
        return self::MEDIUM;
    }
}