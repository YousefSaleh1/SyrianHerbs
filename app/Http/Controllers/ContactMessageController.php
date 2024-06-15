<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ContactMessageResource;
use App\Http\Requests\ContactMessage\StoreContactMessageRequest;

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
        //Note: The Status Is 201
        //beginTransaction
        try {
            $request->validated();

            $message=ContactMessage::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            $contactMessage=new ContactMessageResource($message);
            return $this->customeResponse($contactMessage, 'message added!', 201);
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
        return $this->customeResponse($data, 'Done you can see the message you want', 200);
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
