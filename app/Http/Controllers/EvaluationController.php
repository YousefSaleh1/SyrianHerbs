<?php

namespace App\Http\Controllers;

use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Http\Requests\Evaluation\UpdateEvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Http\Request;;
use App\Http\Resources\EvaluationResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    use ApiResponseTrait, UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        $data = EvaluationResource::collection($evaluations);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request)
    {
        try {
            $evaluation = Evaluation::create([
                'icon'        => $this->uploadFile($request, 'Evaluation', 'icon'),
                'title'       => $request->title,
                'description' => $request->description
            ]);

            $data = new EvaluationResource($evaluation);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $data = new EvaluationResource($evaluation);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        try {
            $evaluation->icon        = $this->fileExists($request, 'Evaluation', 'icon') ?? $evaluation->icon;
            $evaluation->title       = $request->input('title') ?? $evaluation->title;
            $evaluation->description = $request->input('description') ?? $evaluation->description;

            $evaluation->save();

            $data = new EvaluationResource($evaluation);
            return $this->customeResponse($data, 'Successfully Updated',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return response()->json(['message' => 'Evaluation Deleted'], 200);
    }
}
