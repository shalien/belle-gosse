<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderLink\StoreProviderLinkRequest;
use App\Http\Requests\Api\ProviderLink\UpdateProviderLinkRequest;
use App\Http\Resources\ProviderLinkResource;
use App\Http\Resources\ProviderResource;
use App\Models\ProviderLink;
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
        return ProviderLinkResource::collection(ProviderLink::all());
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

    public function showWithProviders(ProviderLink $providerLink)
    {
        //
        return ProviderResource::collection(ProviderLink::findOrFail($providerLink->id)->providers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderLinkRequest $request, ProviderLink $providerLink)
    {
        //
        $providerLink = ProviderLink::findOrFail($providerLink->id);

        DB::beginTransaction();

        try {
            $providerLink->update($request->validated());

            $providerLink->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();

        return new ProviderLinkResource($providerLink);
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

        return response()->json(['message' => 'OldProvider link deleted successfully'], 200);
    }
}
