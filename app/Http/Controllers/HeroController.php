<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hero\UpdateHeroRequest;
use App\Models\Hero;
use Illuminate\Http\Request;;
use App\Http\Resources\HeroResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    use ApiResponseTrait, UploadFile;

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        $data = new HeroResource($hero);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroRequest $request, Hero $hero)
    {
        try {
            $hero->title = $request->input('title') ?? $hero->title;
            $hero->image = $this->fileExists($request, 'Hero', 'image') ?? $hero->file;

            $hero->save();

            $data = new HeroResource($hero);
            return $this->customeResponse($data, 'Successfully Updated', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }
}
