<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProhibitedDomain\StoreProhibitedDomainRequest;
use App\Http\Resources\ProhibitedDomainResource;
use App\Models\ProhibitedDomain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProhibitedDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return ProhibitedDomainResource::collection(ProhibitedDomain::all());
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
    public function store(StoreProhibitedDomainRequest $request)
    {
        //

        $prohibitedDomain = null;

        try {
            DB::beginTransaction();

            $prohibitedDomain = ProhibitedDomain::create($request->validated());

            $prohibitedDomain->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new ProhibitedDomainResource($prohibitedDomain);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
