<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        //Note: Where is Form Request In Update?
        return [
            'name' => 'nullable|string',
            'published' => 'nullable|boolean',
            'brand_id' => 'nullable|array',
            'brand_id.*' => 'exists:brands,id'
        ];
    }
}
