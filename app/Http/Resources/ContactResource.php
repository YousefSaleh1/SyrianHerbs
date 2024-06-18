<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //Note
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'adresses' => $this->adresses,
            'facebook_link' => $this->facebook_link,
            'instegram_link' => $this->instegram_link,
            'whatsApp_number' => $this->whatsApp_number,
            'twitter_link' => $this->twitter_link,
            'linkedin_link' => $this->linkedin_link,
            'youtube_link' => $this->youtube_link,
        ];
    }
}
