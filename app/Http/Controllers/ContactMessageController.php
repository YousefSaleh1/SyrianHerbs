<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessage\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;;
use App\Http\Resources\ContactMessageResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactMessages = ContactMessage::all();
        $data = ContactMessageResource::collection($contactMessages);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactMessageRequest $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        $data = new ContactMessageResource($contactMessage);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return response()->json(['message' => 'ContactMessage Deleted'], 200);
    }
}
