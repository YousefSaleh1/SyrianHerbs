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
            Log::info('Update request received', $request->all());
            $advantage->title = $request->input('title');
            $advantage->description = $request->input('description');

            if ($request->hasFile('main_image')) {
                $advantage->main_image = $request->file('main_image');
            }

            if ($request->hasFile('image1')) {
                $advantage->image1 = $request->file('image1');
            }

            if ($request->hasFile('image2')) {
                $advantage->image2 = $request->file('image2');
            }

            if ($request->hasFile('image3')) {
                $advantage->image3 = $request->file('image3');
            }

            if ($request->hasFile('image4')) {
                $advantage->image4 = $request->file('image4');
            }
            if ($request->hasFile('image5')) {
                $advantage->image5 = $request->file('image5');
            }
            $advantage->save();
            $response = new AdvantageResource($advantage);
            return $this->customeResponse($response, 'Updated successfully!', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something went wrong'], 500);

        }
    }
}
