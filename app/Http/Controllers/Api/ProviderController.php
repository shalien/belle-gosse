<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\StoreProviderRequest;
use App\Http\Requests\Api\Provider\UpdateProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\SourceResource;
use App\Models\Provider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    //

    public function index()
    {
        return ProviderResource::collection(Provider::all());
    }

    public function show(Provider $provider)
    {
        return new ProviderResource(Provider::findOrFail($provider->id));
    }

    public function showByTopic(Request $request)
    {
        return ProviderResource::collection(Provider::where('topic_id', '=', $request['topic_id'])->get());
    }

    public function showByProviderLink(Request $request)
    {
        return ProviderResource::collection(Provider::where('provider_link_id', '=', $request['provider_link_id'])->get());
    }

    public function showSources(Provider $provider) {
        return SourceResource::collection($provider->sources);
    }



    public function store(StoreProviderRequest $request)
    {

        $provider = null;

        try {
            DB::beginTransaction();

            $provider = Provider::create($request->validated());


            $provider->topic()->associate($request->validated()['topic_id']);

            $provider->provider_link()->associate($request->validated()['provider_link_id']);


            $provider->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new ProviderResource(Provider::findOrFail($provider->id));
    }

    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        try {
            DB::beginTransaction();

            $provider->update($request->validated());

            $provider->provider_link()->associate($request->validated()['provider_link_id']);

            $provider->topic()->associate($request->validated()['topic_id']);

            $provider->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new ProviderResource(Provider::findOrFail($provider->id));
    }

    public function destroy(Provider $provider)
    {
        return $provider->delete()
            ? response()->json(['message' => 'Provider deleted successfully'], Response::HTTP_NO_CONTENT)
            : response()->json(['message' => 'Unable to delete provider'], Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}
