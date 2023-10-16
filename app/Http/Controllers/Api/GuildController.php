<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Guild\StoreGuildRequest;

use App\Http\Requests\Api\Guild\UpdateGuildRequest;
use App\Http\Resources\GuildResource;
use App\Http\Resources\UserResource;
use App\Models\Guild;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GuildController extends Controller
{
    /**
     * Display a listing of the reguild.
     */
    public function index()
    {
        //

        return GuildResource::collection(Guild::all());
    }

    /**
     * Show the form for creating a new reguild.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created reguild in storage.
     */
    public function store(StoreGuildRequest $request)
    {
        //

        $guild = null;

        try {
            DB::beginTransaction();
            $guild = Guild::create($request->validated());

            $guild->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new GuildResource($guild);
    }

    /**
     * Display the specified reguild.
     */
    public function show(Guild $guild)
    {
        //
        return new GuildResource(Guild::findOrFail($guild->snowflake));
    }

    /**
     * Show the form for editing the specified reguild.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified reguild in storage.
     */
    public function update(UpdateGuildRequest $request, Guild $guild)
    {
        //

        try {
            DB::beginTransaction();
            $guild = Guild::findOrFail($guild->snowflake);
            $guild->update($request->validated());
            $guild->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new GuildResource($guild);
    }

    /**
     * Remove the specified reguild from storage.
     */
    public function destroy(Guild $guild)
    {
        //

        try {
            DB::beginTransaction();
            $guild = Guild::findOrFail($guild->snowflake);
            $guild->delete();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

       return  response()->json(['message' => 'Guild deleted successfully'], Response::HTTP_OK);

    }


    public function getUsers(Guild $guild)
    {
        //
        return UserResource::collection(Guild::findOrFail($guild->snowflake)->users);
    }
}
