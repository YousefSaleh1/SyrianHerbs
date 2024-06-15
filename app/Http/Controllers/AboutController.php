<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;;
use App\Http\Resources\AboutResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        $data = new AboutResource($about);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        try {
            Log::info('Update request received', $request->all());
            $about->title = $request->title;
            $about->description = $request->description;
            if ($request->hasFile('file')) {
                $about->file = $request->file('file');
            }
            $about->save();
            $response = new AboutResource($about);
            return $this->customeResponse($response, 'Updated successfully!', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }
}
