<?php

namespace App\Http\Controllers;

use App\Http\Requests\Certification\StoreCertificationRequest;
use App\Http\Requests\Certification\UpdateCertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;;
use App\Http\Resources\CertificationResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class CertificationController extends Controller
{
    use ApiResponseTrait, UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certifications = Certification::paginate(10);
        $data = $certifications->through(fn($certification) => new CertificationResource($certification));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCertificationRequest $request)
    {
        try {
            $certification = Certification::create([
                'icon'        => $this->uploadFile($request, 'Certification', 'icon'),
                'name'        => $request->name,
                'subname'     => $request->subname,
                'description' => $request->description,
                'photo'       => $this->uploadFile($request, 'Certification', 'photo'),
            ]);

            $data = new CertificationResource($certification);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Certification $certification)
    {
        $data = new CertificationResource($certification);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificationRequest $request, Certification $certification)
    {
        try {
            $certification->icon         = $this->fileExists($request, 'Certification', 'icon') ?? $certification->icon;
            $certification->name         = $request->input('name') ?? $certification->name;
            $certification->subname      = $request->input('subname') ?? $certification->subname;
            $certification->photo        = $this->fileExists($request, 'Certification', 'photo') ?? $certification->photo;
            $certification->description  = $request->input('description') ?? $certification->description;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();
        return response()->json(['message' => 'Certification Deleted'], 200);
    }
}
