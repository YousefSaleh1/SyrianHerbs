<?php

namespace App\Http\Controllers;

use App\Http\Requests\Story\StoreStoryRequest;
use App\Http\Requests\Story\UpdateStoryRequest;
use App\Models\Story;
use Illuminate\Http\Request;;
use App\Http\Resources\StoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    use ApiResponseTrait, UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storys = Story::paginate(10);
        $data = $storys->through(fn($story) => new StoryResource($story));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryRequest $request)
    {
        try {
            $story = Story::create([
                'description' => $request->description,
                'file'        => $this->uploadFile($request, 'Story', 'file')
            ]);

            $data = new StoryResource($story);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        $data = new StoryResource($story);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryRequest $request, Story $story)
    {
        try {
            $story->description = $request->input('description') ?? $story->description;
            $story->file = $this->fileExists($request, 'Story', 'file') ?? $story->file;

            $story->save();

            $data = new StoryResource($story);
            return $this->customeResponse($data, 'Successfully Updated',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return response()->json(['message' => 'Story Deleted'], 200);
    }
}
