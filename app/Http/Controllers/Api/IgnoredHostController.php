<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IgnoredHost\StoreRequest;
use App\Models\IgnoredHost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class IgnoredHostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {
        //
        return IgnoredHost::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        //
        $ignored_host = null;

        try {
            DB::beginTransaction();

            $ignored_host = IgnoredHost::create($request->validated());

            $ignored_host->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return response(json_encode(['id' => $ignored_host->id]), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function show(IgnoredHost $ignoredHost)
    {
        //
        return $ignoredHost->toJson();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IgnoredHost $ignoredHost)
    {
        //
        $ignoredHost->delete();
    }
}
