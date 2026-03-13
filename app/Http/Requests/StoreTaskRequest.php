<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules — always return plain strings,
     * never enum instances, so Eloquent casting works cleanly.
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'sometimes|nullable|in:low,medium,high',
            'status'      => 'sometimes|nullable|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.required'     => 'Task title is required.',
            'title.max'          => 'Task title must not exceed 255 characters.',
            'priority.in'        => 'Priority must be one of: low, medium, high.',
            'status.in'          => 'Status must be one of: pending, in_progress, completed.',
            'due_date.date'      => 'Due date must be a valid date.',
            'assigned_to.exists' => 'The assigned user does not exist.',
        ];
    }
}
