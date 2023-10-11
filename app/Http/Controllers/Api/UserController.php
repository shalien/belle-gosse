<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            $user->password = bcrypt(Str::random(32));

            if($request->validated()['email'] != null) {
                $user->email = $request->validated()['email'];
            }else {
                $user->email = $user->snowflake . '@' . 'nonrouted.null';
            }

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
        return new UserResource(User::findOrFail($user->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
