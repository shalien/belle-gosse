<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderType\StoreRequest;
use App\Http\Resources\ProviderTypeResource;
use App\Models\ProviderType;
use Illuminate\Http\Request;
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
     * @param StoreRequest $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        //

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

        return response(json_encode(['id' => $provider_type->id]), 200);


    }

    /**
     * Display the specified resource.
     *
     * @param ProviderType $providerType
     * @return ProviderTypeResource
     */
    public function show(ProviderType $providerType)
    {
        //
        return new ProviderTypeResource($providerType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
