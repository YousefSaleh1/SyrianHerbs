<?php

namespace App\Http\Requests\Story;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoryRequest extends FormRequest
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
            'description' => 'nullable|string|max:50000',
            'file'        => 'nullable|file|max:51200|mimetypes:image/jpeg,image/png,image/jpg,video/*',
        ];
    }
}
