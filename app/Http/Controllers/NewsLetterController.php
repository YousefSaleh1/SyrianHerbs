<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsLetter\StoreNewsLetterRequest;
use App\Models\NewsLetter;
use Illuminate\Http\Request;;
use App\Http\Resources\NewsLetterResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class NewsLetterController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsLetters = NewsLetter::paginate(10);
        $data = $newsLetters->through(fn($newsLetter) => new NewsLetterResource($newsLetter));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsLetterRequest $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsLetter $newsLetter)
    {
        $newsLetter->delete();
        return response()->json(['message' => 'NewsLetter Deleted'], 200);
    }
}
