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
            $contact->update([
                'email' => $request->input('email') ?? $contact->email,
                'phone_number' => $request->input('phone_number') ?? $contact->phone_number,
                'adresses' => $request->input('adresses') ??  $contact->adresses,
                'facebook_link' => $request->input('facebook_link') ?? $contact->facebook_link,
                'instegram_link' => $request->input('instegram_link') ??  $contact->instegram_link,
                'whatsApp_number' => $request->input('whatsApp_number') ?? $contact->whatsApp_number,
                'twitter_link' => $request->input('twitter_link') ?? $contact->twitter_link,
                'linkedin_link' => $request->input('linkedin_link') ?? $contact->linkedin_link,
                'youtube_link' => $request->input('youtube_link') ?? $contact->youtube_link,
            ]);

            return $this->customeResponse(new ContactResource($contact), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }
}
