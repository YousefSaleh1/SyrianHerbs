<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Note : Where is Resource?
        // Note: where is ID?
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'tags' => $this->tags,
            'meta_pixel_id' => $this->meta_pixel_id,
            'google_analystic_id' => $this->google_analystic_id,
            'website_icon' => $this->website_icon,
            'website_logo' => $this->website_logo,
        ];
    }
}

