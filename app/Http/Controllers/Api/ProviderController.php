<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\StoreRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    //

    public function index()
    {

    return ProviderResource::collection(Provider::all());
    }

    public function show(Provider $provider)
    {
        return new ProviderResource($provider);
    }

    public function byTopicId(Topic $topic)
    {
        return ProviderResource::collection(Provider::where('topic_id', '=', $topic->id)->get());
    }

    public function store(StoreRequest $request)
    {

        $provider = null;

        try {
            DB::beginTransaction();

            $provider = Provider::create($request->validated());

            $provider->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response(json_encode(['id' => $provider->id]), 200);
    }


    public function destroy(Provider $provider)
    {
        try {
            DB::beginTransaction();

            $provider->delete();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response();

    }
}
