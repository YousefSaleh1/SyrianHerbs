<?php

namespace App\Http\Requests\Evaluation;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'icon'        => 'required|image|mimes:svg|max:10000',
            'title'       => 'required|string|max:225',
            'description' => 'required|string'
        ];
    }
}
