<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderLink\StoreProviderLinkRequest;
use App\Http\Requests\Api\ProviderLink\UpdateProviderLinkRequest;
use App\Http\Resources\ProviderLinkResource;
use App\Models\ProviderLink;
use http\Env\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ProviderLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        //
        return ProviderLinkResource::collection(ProviderLink::with('provider_type', 'providers')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProviderLinkRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $providerLink = ProviderLink::create($request->validated());

            if($request->has('providers')) {
                $providerLink->providers()->sync($request->providers);
            }

            $providerLink->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();

        return new ProviderLinkResource($providerLink);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProviderLink $providerLink)
    {
        //

        return new ProviderLinkResource(ProviderLink::with('providers')->findOrFail($providerLink->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderLinkRequest  $request, ProviderLink $providerLink)
    {
        //
        $providerLink = ProviderLink::findOrFail($providerLink->id);

        DB::beginTransaction();

        try {
            $providerLink->update($request->validated());

            if($request->has('providers')) {
                $providerLink->providers()->sync($request->providers);
            }

            $providerLink->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProviderLink $providerLink)
    {
        //
        $providerLink = ProviderLink::findOrFail($providerLink->id);

        DB::beginTransaction();

        try {
            $providerLink->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();

        return response()->json(['message' => 'Provider link deleted successfully'], 200);
    }
}
