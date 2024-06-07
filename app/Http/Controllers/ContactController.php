<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;;
use App\Http\Resources\ContactResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $data = new ContactResource($contact);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }
}
