<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        //Note: Where is Form Request In Store?
        return [
            'name' => 'required|string',
            'published' => 'required|boolean',
// <<<<<<< maya_branch
            // 'brand_id' => 'exists:brands,id',
// =======
            'brand_id' => 'required|array',
            'brand_id.*' => 'exists:brands,id'
// >>>>>>> main
        ];
    }
}
