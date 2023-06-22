<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\StoreProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use App\Models\Topic;
use Illuminate\Http\Response;
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
        return new ProviderResource(Provider::findOrFail($provider->id));
    }

    public function byTopicId(Topic $topic)
    {
        return ProviderResource::collection(Provider::where('topic_id', '=', $topic->id)->get());
    }

    public function store(StoreProviderRequest $request)
    {

        $provider = null;

        try {
            DB::beginTransaction();

            $provider = Provider::create($request->validated());

            $provider->topic()->associate($request->validated()['topic_id']);
            $provider->provider_type()->associate($request->validated()['provider_type_id']);

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
