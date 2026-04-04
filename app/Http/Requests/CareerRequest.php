<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', 'in:unemployed,job,freelance,entrepreneur,job_freelance'],
            'income' => ['nullable', 'numeric', 'min:0'],
            'company' => ['nullable', 'string', 'max:200'],
            'designation' => ['nullable', 'string', 'max:150'],
            'join_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:200'],
            'platform' => ['nullable', 'string', 'max:100'],
            'profile_link' => ['nullable', 'url', 'max:500'],
            'completed_projects' => ['nullable', 'integer', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'business_name' => ['nullable', 'string', 'max:200'],
            'business_type' => ['nullable', 'string', 'max:150'],
            'employees' => ['nullable', 'integer', 'min:0'],
            'business_website' => ['nullable', 'url', 'max:500'],
            'story' => ['nullable', 'string'],
        ];
    }
}
