<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    use ApiResponseTrait;

    /**
     * Display a listing of the users.
     *
     * This method retrieves all users from the database, transforms them into a collection of UserResource,
     * and returns a custom response with the data and a success message.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing the list of users and a success message.
     */
    public function index()
    {
        $users = User::all();
        $data = UserResource::collection($users);
        return $this->customeResponse($data, 'Done!', 200);
    }


    /**
     * Store a newly created user in storage.
     *
     * This method handles the creation of a new user. It begins a database transaction,
     * creates the user with the provided data, assigns roles to the user, and commits the transaction.
     * If an error occurs, it logs the error, rolls back the transaction, and returns a failure response.
     *
     * @param StoreUserRequest $request The request object containing the user data.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success or failure.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'user_name' => $request->user_name,
                'password'  => $request->password
            ]);
            $user->assignRole($request->input('roles'));

            DB::commit();
            $data = new UserResource($user);
            return $this->customeResponse($data, 'Successfully Created', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return response()->json(['message' => 'Failed To Create'], 500);
        }
    }

    /**
     * Display the specified user.
     *
     * This method retrieves a specific user from the database, transforms it into a UserResource,
     * and returns a custom response with the data and a success message.
     *
     * @param User $user The user instance to be displayed.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the user data and a success message.
     */
    public function show(User $user)
    {
        $data = new UserResource($user);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified user in storage.
     *
     * This method handles the update of an existing user. It begins a database transaction,
     * updates the user's information with the provided data, reassigns roles to the user,
     * and commits the transaction. If an error occurs, it logs the error, rolls back the transaction,
     * and returns a failure response.
     *
     * @param UpdateUserRequest $request The request object containing the user data.
     * @param User $user The user instance to be updated.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success or failure.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->user_name = $request->input('user_name') ?? $user->user_name;
            $user->save();
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            $user->assignRole($request->input('roles'));

            DB::commit();
            $data = new UserResource($user);
            return $this->customeResponse($data, 'Successfully Updated', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return response()->json(['message' => 'Something Error !'], 500);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * This method handles the deletion of a user. It deletes the user from the database
     * and returns a JSON response indicating the success of the operation.
     *
     * @param User $user The user instance to be deleted.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the user has been deleted.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User Deleted'], 200);
    }
}
