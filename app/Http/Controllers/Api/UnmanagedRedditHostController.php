<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UnmanagedRedditHost\StoreUnmanagedRedditHostRequest;
use App\Http\Resources\UnmanagedRedditHostResource;
use App\Models\UnmanagedRedditHost;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UnmanagedRedditHostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {
        //
        return UnmanagedRedditHost::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return UnmanagedRedditHostResource|\Illuminate\Http\JsonResponse|Response
     */
    public function store(StoreUnmanagedRedditHostRequest $request)
    {
        //
        $unmanagedRedditHost = null;

        try {
            DB::beginTransaction();

            $unmanagedRedditHost = UnmanagedRedditHost::create($request->validated());

            $unmanagedRedditHost->save();

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new UnmanagedRedditHostResource(UnmanagedRedditHost::findOrFail($unmanagedRedditHost->id));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUnmanagedRedditHostRequest $request, UnmanagedRedditHost $unmanagedreddithost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
