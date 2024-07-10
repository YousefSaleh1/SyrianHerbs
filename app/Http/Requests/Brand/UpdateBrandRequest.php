<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name'               => 'nullable|string|max:50',
            'description'        => 'nullable|string',
            'main_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'presentation_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'background_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'published'          => 'nullable|string|in:true,false',
            'color'              => 'nullable|string|',
        ];
    }
}
