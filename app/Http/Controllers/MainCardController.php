<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainCardController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $product_count = Product::count();
        $category_count = Category::count();
        $brand_image = Brand::select('id', 'main_image')->get();
        $brand_count = Brand::count();

        $data = [
            'products_count'   => $product_count,
            'brands' => [
                'brands_count' => $brand_count,
                'brands_image' => $brand_image,
            ],
            'categories_count' => $category_count,
        ];

        return $this->customeResponse($data, 'Done!', 200);
    }
}
