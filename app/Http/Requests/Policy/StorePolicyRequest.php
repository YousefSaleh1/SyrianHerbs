<?php

namespace App\Http\Requests\Policy;

use Illuminate\Foundation\Http\FormRequest;

class StorePolicyRequest extends FormRequest
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
            'policy_number' => 'required|numeric|min:2|max:50',
            'icon'=>'required|image|mimes:svg|max:10000000',
            'title'=>'required|string|max:50|min:5',
            'description'=>'required|string|max:255|min:10',
        ];
    }
}
