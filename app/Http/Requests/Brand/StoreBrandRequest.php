<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:10|max:500',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'presentation_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'published' => 'required|string|in:true,false',
            'color' => 'required|string',
        ];
    }
}
