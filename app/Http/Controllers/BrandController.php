<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    use ApiResponseTrait, UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        $data = $brands->through(fn ($brand) => new BrandResource($brand));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {

        //Note: beginTransaction
        try {
            $brand = Brand::create([
                'name'    => $request->name,
                'description' => $request->description,
                'main_image' => $this->uploadFile($request, 'Brand', 'main_image'),
                'presentation_image' => $this->uploadFile($request, 'Brand', 'presentation_image'),
                'published' => $request->published == 'true' ? 1 : 0,
                'color' => $request->color,
                'background_image' => $this->uploadFile($request, 'Brand', 'background_image'),
            ]);

            $data = new BrandResource($brand);
            return $this->customeResponse($data, 'brand created successful', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed', 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $data = new BrandResource($brand);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //Note
        try {

            $brand->name                = $request->input('name') ?? $brand->name;
            $brand->description         = $request->input('description') ?? $brand->description;
            $brand->published           = ($request->input('published') === 'true' ? 1 : 0) ?? $brand->published;
            $brand->color               = $request->input('color') ?? $brand->color;
            $brand->main_image          = $this->fileExists($request, 'Brand', 'main_image') ?? $brand->main_image;
            $brand->presentation_image  = $this->fileExists($request, 'Brand', 'presentation_image') ?? $brand->presentation_image;
            $brand->background_image    = $this->fileExists($request, 'Brand', 'background_image') ?? $brand->background_image;

            $brand->save();
            $data = new BrandResource($brand);
            return $this->customeResponse($data, 'brand updated successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'brand not found', 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return $this->customeResponse(null, 'brand deleted successfully', 200);
    }


    /**
     * Search By BrandName :
     */

    public function searchByBrandName($searchBrand)
    {
        $brands = Brand::search($searchBrand)->get();
        return $this->customeResponse($brands, 'search by Brand Name was successful', 200);
    }

    /**
     * Display the specified resource in the site view.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the specified brand is not found.
     */
    public function showInSite(Brand $brand)
    {
        $brandWithRelation = Brand::getBrandWithCategoriesAndProducts($brand->id);
        return $this->customeResponse($brandWithRelation, 'Done!', 200);
    }

    public function get_brands_published()
    {
        $brands = Brand::where('published', 1)->get();
        $data = BrandResource::collection($brands);
        return $this->customeResponse($data, 'Done!', 200);
    }
}
