<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;;

use App\Http\Resources\BrandResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    use ApiResponseTrait, UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        $data = BrandResource::collection($brands);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        //Note: beginTransaction
        try {
            DB::beginTransaction();
            $brand = Brand::create([
                'name'    => $request->name,
                'description' => $request->description,
                'main_image' => $request->main_image,
                'presentation_image' => $request->presentation_image,
                'published' => $request->published,
                'color' => $request->color,
                'background_image' => $request->background_image,
            ]);

            DB::commit();
            $data = new BrandResource($brand);
            return $this->customeResponse($data, 'brand created successful', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
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
            DB::beginTransaction();
            $brand->update([
                'name'    => $request->name,
                'description' => $request->description,
                'main_image' => $request->main_image,
                'presentation_image' => $request->presentation_image,
                'background_image' => $request->background_image,
                'published' => $request->published,
                'color' => $request->color,
            ]);
            DB::commit();
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
}
