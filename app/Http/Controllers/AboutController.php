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
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }
}
