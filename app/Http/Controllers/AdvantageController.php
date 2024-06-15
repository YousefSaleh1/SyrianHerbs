<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advantage\UpdateAdvantageRequest;
use App\Models\Advantage;
use Illuminate\Http\Request;;
use App\Http\Resources\AdvantageResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class AdvantageController extends Controller
{
    use ApiResponseTrait, UploadFile;

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
        //Note
        try {
            Log::info('Update request received', $request->all());
            $advantage->title = $request->input('title') ?? $advantage->title;
            $advantage->description = $request->input('description') ?? $advantage->description ;
            $advantage->main_image = $this->fileExists($request, 'Advantage', 'main_image') ?? $advantage->main_image;
            $advantage->image1 = $this->fileExists($request, 'Advantage', 'image1') ?? $advantage->image1;
            $advantage->image2 = $this->fileExists($request, 'Advantage', 'image2') ?? $advantage->image2;
            $advantage->image3 = $this->fileExists($request, 'Advantage', 'image3') ?? $advantage->image3;
            $advantage->image4 = $this->fileExists($request, 'Advantage', 'image4') ?? $advantage->image4;
            $advantage->image5 = $this->fileExists($request, 'Advantage', 'image5') ?? $advantage->image5;

            $advantage->save();
            $response = new AdvantageResource($advantage);
            return $this->customeResponse($response, 'Updated successfully!', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something went wrong'], 500);

        }
    }
}
