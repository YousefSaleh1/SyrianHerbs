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
        //phone_number and whatsApp_number is numeric
        return [
            'email' => 'nullable|email',
            'phone_number' => 'nullable|numeric',
            'adresses' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'instegram_link' => 'nullable|url',
            'whatsApp_number' => 'nullable|numeric',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ];
    }
}
