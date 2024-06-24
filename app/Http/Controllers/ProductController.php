<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ProductResource;
use App\Http\Resources\DuplicateProduct;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    use ApiResponseTrait , UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        $data = $products->through(fn($product) => new ProductResource($product));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $brand_id    = $request->input('brand_id');
            $category_id = $request->input('category_id');

            $product = Product::create([
                'brand_id'              => $brand_id,
                'category_id'           => $category_id,
                'name'                  => $request->name,
                'subname1'              => $request->subname1,
                'subname2'              => $request->subname2,
                'product_description'   => $request->product_description,
                'code_number'           => $request->code_number,
                'weight'                => $request->weight,
                'packaging_description' => $request->packaging_description,
                'description_component' => $request->description_component,
                'count_each_package'    => $request->count_each_package,
                'main_image'            => $this->uploadFile($request,'Product','main_image'),
                'additional_image'      => $this->uploadFile($request,'Product','additional_image'),
            ]);
            return $this->customeResponse(new ProductResource($product), 'Product Created Successfully', 200);

        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = new ProductResource($product);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->name                  = $request->input('name')  ?? $product->name;
            $product->subname1              = $request->input('subname1')  ?? $product->subname1;
            $product->subname2              = $request->input('subname2')  ?? $product->subname2;
            $product->product_description   = $request->input('product_description')  ?? $product->product_description;
            $product->code_number           = $request->input('code_number')  ?? $product->code_number;
            $product->weight                = $request->input('weight')  ?? $product->weight;
            $product->packaging_description = $request->input('packaging_description')  ?? $product->packaging_description;
            $product->description_component = $request->input('description_component')  ?? $product->description_component;
            $product->count_each_package    = $request->input('count_each_package')  ?? $product->count_each_package;
            $product->main_image            = $this->fileExists($request, 'Product', 'main_image') ?? $product->main_image;
            $product->additional_image      = $this->fileExists($request, 'Product', 'additional_image') ?? $product->additional_image;

            $product->save();
            return $this->customeResponse(new ProductResource($product), 'Product updated Successfully', 200);

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product Deleted'], 200);
    }

    /**
     * Duplicate the Product .
    */
    public function duplicateProduct(Product $product)
    {
        $newProduct = $product->replicate();
        $newProduct->save();
        return $this->customeResponse(new DuplicateProduct($newProduct), 'Product duplicated successfully', 200);
    }

    /**
     * Search By Name .
    */

    public function search($search)
    {
        $products= Product::search($search)->get();
        return $this->customeResponse($products, 'search by name was successful', 200);
    }


    /* Filters : */

    /**
     * Filter By Category .
    */

    public function filterByCategory($category)
    {
        $products = Product::where('category_id', $category)->get();
        return $this->customeResponse($products, ' Filter By Category was successful', 200);
    }

    /**
     * Filter By Brand .
    */

    public function filterByBrand($brand)
    {
        $products = Product::where('brand_id', $brand)->get();
        return $this->customeResponse($products, ' Filter By Brand was successful', 200);
    }

}
