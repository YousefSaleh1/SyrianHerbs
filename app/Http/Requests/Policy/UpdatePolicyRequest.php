<?php

namespace App\Http\Requests\Policy;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePolicyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'policy_number' => 'nullable|numeric|max:50',
            'icon' => 'nullable|image|mimes:svg',
            'title' => 'nullable|string|max:50|min:5',
            'description' => 'nullable|string|max:255|min:10',
        ];
    }
}
