<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioSettingRequest extends FormRequest
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
        $userId = $this->user()->id;

        return [
            'slug' => ['sometimes', 'required', 'string', 'min:3', 'max:50', 'regex:/^[a-z0-9-]+$/', Rule::unique('portfolio_settings', 'slug')->ignore($userId, 'user_id')],
            'theme' => ['sometimes', 'required', 'in:green,blue,purple,dark,teal'],
            'is_visible' => ['sometimes', 'boolean'],
            'tagline' => ['nullable', 'string', 'max:200'],
        ];
    }
}
