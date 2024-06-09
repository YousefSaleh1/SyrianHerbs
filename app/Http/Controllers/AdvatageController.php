<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advantage\UpdateAdvantageRequest;
use App\Http\Resources\AdvantageResource;
use Illuminate\Http\Request;;
use App\Http\Resources\AdvatageResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Advantage;
use Illuminate\Support\Facades\Log;

class AdvatageController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */
    public function show(Advantage $advatage)
    {
        $data = new AdvantageResource($advatage);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvantageRequest $request, Advantage $advatage)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

}
