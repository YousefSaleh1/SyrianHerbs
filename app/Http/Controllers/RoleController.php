<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
    //     $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
    //     $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
    //     $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    // }

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        $data = RoleResource::collection($roles);
        return $this->customeResponse($data, 'Done!', 200);
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            DB::commit();
            $data = new RoleResource($role);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return response()->json(['message' => 'Failed To Create'], 500);
        }
    }

    public function show(Role $role)
    {
        $data = new RoleResource($role);
        return $this->customeResponse($data, "Done", 200);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $role->name = $request->input('name') ?? $role->name;
            $role->save();

            $role->syncPermissions($request->input('permission'));

            DB::commit();
            $data = new RoleResource($role);
            return $this->customeResponse($data, 'Successfully Updated', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role Deleted'], 200);
    }
}
