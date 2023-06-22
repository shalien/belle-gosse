<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderType\StoreProviderTypeRequest;
use App\Http\Requests\Api\ProviderType\UpdateProviderTypeRequest;
use App\Http\Resources\ProviderTypeResource;
use App\Models\ProviderType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProviderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ProviderTypeResource::collection(ProviderType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ProviderTypeResource
     */
    public function store(StoreProviderTypeRequest $request)
    {
        //
        $provider_type = null;

        try {
            DB::beginTransaction();

            $provider_type = ProviderType::create($request->validated());

            $provider_type->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return new ProviderTypeResource(ProviderType::findOrfail($provider_type->id));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     */
    public function show(ProviderType $providertype): ProviderTypeResource
    {
        return new ProviderTypeResource(ProviderType::findOrFail($providertype->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderTypeRequest $request, ProviderType $providertype): ProviderTypeResource
    {
        //
        try {
            DB::beginTransaction();

            $providertype->update($request->validated());

            $providertype->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return new ProviderTypeResource(ProviderType::findOrfail($providertype->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProviderType $providertype)
    {
        //

        return $providertype->delete()
            ? response()->json(['message' => 'Provider Type deleted successfully'], Response::HTTP_NO_CONTENT)
            : response()->json(['message' => 'Provider Type could not be deleted'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
