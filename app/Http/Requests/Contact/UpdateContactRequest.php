<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'email' => 'nullable|email',
            'phone_number' => 'nullable|regex:/^\+?[0-9]+$/',
            'adresses' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'instegram_link' => 'nullable|url',
            'whatsApp_number' => 'nullable|string',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ];
    }
}
