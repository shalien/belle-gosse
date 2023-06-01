<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderType\StoreRequest;
use App\Models\IgnoredHost;
use App\Models\ProviderType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProviderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        return JsonResponse::fromJsonString(ProviderType::all()->toJson());
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
     * @return string
     */
    public function show(ProviderType $providerType)
    {
        //
        return $providerType->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
