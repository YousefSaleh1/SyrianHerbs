<?php

namespace App\Http\Controllers;
use App\Models\Brand;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::paginate(10);
        $data = CategoryResource::collection($categorys);
        return $this->customeResponse($data, 'Done!', 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validate([
                "name" => 'required|string',
                "published" => 'required|boolean',
            ]);

            $category = Category::create([
                'name'        => $request->name,
                'published' => $request->published
            ]);
            $brandId = $request->input('brand_id');
            $category->brands()->attach($brandId);

            $data = new CategoryResource($category);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }


    /**
     * Display the specified resource.
     */


    public function show(Category $category)
    {
    if($category){
        $data = new CategoryResource($category);
        return $this->customeResponse($data, 'Done!', 200);
    }else{
        return response(["msg"=>"didn't success"],401);
    }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

       //Note: Validate must be in Form Request
        try {
            $data = $request->validate([
                "name" => 'required|string',
                "published" => 'required|boolean',
            ]);

            $category->name        = $request->input('name') ?? $category->name;
            $category->published       = $request->input('published') ?? $category->published;

            $category->save();

            $data = new CategoryResource($category);
            return $this->customeResponse($data, 'Successfully Updated',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->brands()->detach();
            $category->delete();
            return response(["msg"=>"category was deleted successfolly "],201);
        }else{
            return response(["msg"=>"didn't success"],401);
        }

    }
}

