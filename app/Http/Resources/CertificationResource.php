<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
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
            'icon'        => $this->icon,
            'name'        => $this->name,
            'subname'     => $this->subname,
            'photo'       => $this->photo,
            'description' => $this->description,
        ];
    }
}
