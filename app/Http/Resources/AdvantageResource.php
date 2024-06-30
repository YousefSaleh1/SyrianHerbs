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
            'image1'      => $this->image1,
            'image2'      => $this->image2,
            'image3'      => $this->image3,
            'image4'      => $this->image4,
            'image5'      => $this->image5,
        ];
    }
}
