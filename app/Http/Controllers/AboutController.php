<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;;
use App\Http\Resources\AboutResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    use ApiResponseTrait, UploadFile;

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
        //Note
        try {
            // Log::info('Update request received', $request->all());
            $about->title = $request->title ?? $about->title;
            $about->description = $request->description ?? $about->description;
            $about->file = $this->fileExists($request, 'About', 'file') ?? $about->file;

            $about->save();
            $response = new AboutResource($about);
            return $this->customeResponse($response, 'Updated successfully!', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }
}
