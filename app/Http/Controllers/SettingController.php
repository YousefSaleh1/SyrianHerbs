<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;;
use App\Http\Resources\SettingResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;
use DB;

class SettingController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */

     //Note 

    public function show($id)
    {

        if($id){
            $setting=Setting::find($id);
            return response()->json($setting);
        }
        else{
            return response(["msg" => "Setting didnt exist", 401 ]);
        }
    }



/*
    public function store(UpdateSettingRequest $request)
    {
        try {
            $data = $request->validated();

            $setting = new Setting();
            $setting->title = $data['title'];
            $setting->description = $data['description'];
            $setting->meta_pixel_id = $data['meta_pixel_id'];
            $setting->google_analystic_id = $data['google_analystic_id'];
            $setting->tags = $data['tags'];
            $setting->website_icon = $data['website_icon'];
            $setting->website_logo = $data['website_logo'];

            $setting->save();

            return response()->json(["msg" => "Setting added successfully"], 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }
    */

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

            $setting->website_icon = $request->input('website_icon') ?? $setting->website_icon;
            $setting->website_logo = $request->input('website_logo') ?? $setting->website_logo;

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

