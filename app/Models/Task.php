<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'assigned_to',
        'ai_summary',
        'ai_priority',
    ];

    /**
     * Attribute casting
     * ✅ Fixed: changed from method to property
     * protected function casts() caused "undefined cast" error
     */
    protected $casts = [
        'priority' => TaskPriority::class,
        'status'   => TaskStatus::class,
        'due_date' => 'date',
    ];

    /**
     * Assigned user relationship
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Filter scope
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['assigned_to'])) {
            $query->where('assigned_to', $filters['assigned_to']);
        }

        return $query;
    }

    /**
     * Check if task completed
     */
    public function isCompleted(): bool
    {
        return $this->status === TaskStatus::COMPLETED;
    }

    /**
     * Check if task high priority
     */
    public function isHighPriority(): bool
    {
        return $this->priority === TaskPriority::HIGH;
    }
}