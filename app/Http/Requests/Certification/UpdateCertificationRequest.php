<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificationRequest extends FormRequest
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
            'icon'        => 'nullable|image|mimes:svg|max:10000',
            'name'        => 'nullable|string|min:2|max:25',
            'subname'     => 'nullable|string|min:2|max:25',
            'photo'       => 'nullable|file|mimes:png,jpg,jpeg|max:10000|mimetypes:image/jpeg,image/png,image/jpg,image',
            'description' => 'nullable|string|min:2|max:25',
        ];
    }
}
