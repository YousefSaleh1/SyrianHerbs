<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                           =>$this->id,
            'name'                         =>$this->name,
            'subname1'                     =>$this->subname1,
            'subname2'                     =>$this->subname2,
            'product_description'          =>$this->product_description,
            'code_number'                  =>$this->code_number,
            'weight'                       =>$this-> weight,
            'packaging_description'        =>$this->packaging_description,
            'description_component'        =>$this->description_component,
            'count_each_package'           =>$this->count_each_package,
            'main_image'                   =>$this->main_image ,
            'additional_image'             =>$this->additional_image,
        ];
    }
}
