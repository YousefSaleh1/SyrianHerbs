<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        /*
        Note:
            1- website_icon is SVG
            2- title is nullable
        */
        return [
        'website_icon' => ' nullable|image|mimes:svg',
        'website_logo' => ' nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/jpg',
        'title' => ' nullable|string|max:255 ',
        'description' => ' nullable|string|max:1000 ',
        'tags' => 'nullable|string|max:255',
        'meta_pixel_id' => ' nullable|string|max:255 ',
        'google_analystic_id' => ' nullable|string|max:255 '

        ];
    }
}
