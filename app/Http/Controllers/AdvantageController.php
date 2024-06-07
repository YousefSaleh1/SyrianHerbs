<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advantage\UpdateAdvantageRequest;
use App\Models\Advantage;
use Illuminate\Http\Request;;
use App\Http\Resources\AdvantageResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class AdvantageController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */
    public function show(Advantage $advantage)
    {
        $data = new AdvantageResource($advantage);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvantageRequest $request, Advantage $advantage)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }
}
