<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificationRequest extends FormRequest
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
            'icon'        => 'required|image|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
            'name'        => 'required|string|min:2|max:50',
            'subname'     => 'nullable|string|min:2|max:50',
            'photo'       => 'required|image|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
            'description' => 'required|string|min:2',
        ];
    }
}
