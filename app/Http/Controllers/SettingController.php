<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;;
use App\Http\Resources\SettingResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;
use DB;

class SettingController extends Controller
{
    use ApiResponseTrait, UploadFile;

    /**
     * Display the specified resource.
     */
    public function show(setting $setting)
    {
        $data = new SettingResource($setting);
        return $this->customeResponse($data, 'Done!', 200);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {

        try {

            // update
            $setting->title = $request->input('title') ?? $setting->title;
            $setting->description = $request->input('description') ?? $setting->description;
            $setting->meta_pixel_id = $request->input('meta_pixel_id') ?? $setting->meta_pixel_id;
            $setting->google_analystic_id = $request->input('google_analystic_id') ?? $setting->google_analystic_id;
            $setting->tags = $request->input('tags') ?? $setting->tags;

            $setting->website_icon = $this->fileExists($request, 'Setting', 'website_icon') ?? $setting->file;
            $setting->website_logo = $this->fileExists($request, 'Setting', 'website_logo') ?? $setting->file;

            // save
            $setting->save();

            $data = new SettingResource($setting);
            return $this->customeResponse($data, 'Setting updated successfully!', 200);
        } catch (\Throwable $th) {

            Log::error($th);
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }
}



