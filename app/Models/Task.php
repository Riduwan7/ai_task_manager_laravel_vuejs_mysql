<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
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
        'ai_priority'
    ];

    /**
     * Type casting
     */
    protected $casts = [
        'priority' => TaskPriority::class,
        'status' => TaskStatus::class,
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (isset($filters['assigned_to'])) {
            $query->where('assigned_to', $filters['assigned_to']);
        }

        return $query;
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isHighPriority(): bool
    {
        return $this->priority === 'high';
    }
}
