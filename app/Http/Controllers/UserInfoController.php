<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfo\StoreUserInfoRequest;
use App\Http\Requests\UserInfo\UpdateUserInfoRequest;
use App\Models\UserInfo;
use Illuminate\Http\Request;;
use App\Http\Resources\UserInfoResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class UserInfoController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userInfos = UserInfo::paginate(10);
        $data = UserInfoResource::collection($userInfos);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserInfoRequest $request)
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
    public function show(UserInfo $userInfo)
    {
        $data = new UserInfoResource($userInfo);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserInfoRequest $request, UserInfo $userInfo)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInfo $userInfo)
    {
        $userInfo->delete();
        return response()->json(['message' => 'UserInfo Deleted'], 200);
    }
}
