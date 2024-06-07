<?php

namespace App\Http\Controllers;

use App\Models\Advatage;
use Illuminate\Http\Request;;
use App\Http\Resources\AdvatageResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class AdvatageController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advatages = Advatage::all();
        $data = AdvatageResource::collection($advatages);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Advatage $advatage)
    {
        $data = new AdvatageResource($advatage);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advatage $advatage)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advatage $advatage)
    {
        $advatage->delete();
        return response()->json(['message' => '{{ Model }} Deleted'], 200);
    }
}
