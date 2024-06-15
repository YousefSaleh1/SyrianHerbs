<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvantageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'main_image'  => $this->main_image,
            'images'      => [
                $this->image1,
                $this->image2,
                $this->image3,
                $this->image4,
                $this->image5,
            ],
        ];
    }
}
