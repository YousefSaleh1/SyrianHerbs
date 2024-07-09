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
            'description'        => 'nullable|string|min:10',
            'main_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'presentation_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'background_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000',
            'published'          => 'nullable|string|in:true,false',
            'color'              => 'nullable|string|',
        ];
    }
}
