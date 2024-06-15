<?php

namespace App\Http\Controllers;

use App\Http\Requests\Policy\StorePolicyRequest;
use App\Http\Requests\Policy\UpdatePolicyRequest;
use App\Models\Policy;
use Illuminate\Http\Request;;

use App\Http\Resources\PolicyResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Log;

class PolicyController extends Controller
{
    use ApiResponseTrait;
    use UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policys = Policy::paginate(10);
        $data = $policys->through(fn($policy) => new PolicyResource($policy));
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePolicyRequest $request)
    {
        try {
            $policy = Policy::create([
                'policy_number' => $request->policy_number,
                'icon' => $this->uploadFile($request,'Policy','icon'),
                'title' => $request->title,
                'description' => $request->description,
            ]);

        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed To Create', 500);
        }
        $data = new PolicyResource($policy);
        return $this->customeResponse($data, 'policy created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Policy $policy)
    {
        $data = new PolicyResource($policy);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdatePolicyRequest $request, Policy $policy)
    {
        try {
            $policy->title=$request->input('title') ?? $policy->title;
            $policy->description=$request->input('description') ?? $policy->description;
            $policy->icon = $this->fileExists($request,'Policy','icon') ?? $policy->file ;
            $policy->policy_number=$request->input('policy_number') ?? $policy->policy_number;
            $policy->save();
            $data = new PolicyResource($policy);
            return $this->customeResponse($data, 'policy Updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Policy $policy)
    {
        $policy->delete();
        return response()->json(['message' => 'Policy Deleted'], 200);
    }
}
