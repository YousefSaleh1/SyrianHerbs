<?php

namespace App\Http\Requests\Advantage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvantageRequest extends FormRequest
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
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'main_image'  => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5'      => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
