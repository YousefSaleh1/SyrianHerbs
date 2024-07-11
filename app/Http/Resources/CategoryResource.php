<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $brands_name = DB::table('brand_category')
            ->where('category_id', $this->id)
            ->join('brands', 'brand_category.brand_id', '=', 'brands.id')
            ->pluck('brands.name');
        $brands_id = DB::table('brand_category')
            ->where('category_id', $this->id)
            ->join('brands', 'brand_category.brand_id', '=', 'brands.id')
            ->pluck('brands.id');

        ////Note: Where is Resource ?
        return [
            'id' => $this->id,
            'name' => $this->name,
            'published' => $this->published,
            'brands_name' => $brands_name,
            'brands_id' => $brands_id,
            'products_count' => $this->products->count()
        ];
    }
}

