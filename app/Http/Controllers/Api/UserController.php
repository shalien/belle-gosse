<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UserTokenRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //

        $user = null;

        try {
            DB::beginTransaction();

            $user = User::create($request->validated());

            $user->save();

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new UserResource($user);
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return new UserResource($user);
    }

    public function findUserBySnowflake(string $snowflake)
    {
        //
        return new UserResource(User::where('snowflake', $snowflake)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //

        try {
            DB::beginTransaction();
            $user = User::where('snowflake', $user->snowflake)->firstOrFail();
            $user->update($request->validated());
            $user->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new UserResource(User::where('snowflake', $user->snowflake)->firstOrFail());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //

        try {
            DB::beginTransaction();
            $user = User::findOrFail($user->id);
            $user->delete();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return response()->json(['success' => 'User deleted successfully'], Response::HTTP_OK);
    }

    public function createToken(UserTokenRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken($request->device_name)->plainTextToken;


            return response()->json(['token' => $token], Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
