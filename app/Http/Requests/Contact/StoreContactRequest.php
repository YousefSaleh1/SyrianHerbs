<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'adresses' => 'required|string',
            'facebook_link' => 'required|url',
            'instegram_link' => 'required|url',
            'whatsApp_number' => 'required|string',
            'twitter_link' => 'required|url',
            'linkedin_link' => 'required|url',
            'youtube_link' => 'required|url',
        ];
    }
}
