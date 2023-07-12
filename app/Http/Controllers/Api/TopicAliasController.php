<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicAlias\StoreTopicAliasRequest;
use App\Http\Requests\Api\TopicAlias\UpdateTopicAliasRequest;
use App\Http\Resources\TopicAliasResource;
use App\Models\TopicAlias;
use Illuminate\Support\Facades\DB;

class TopicAliasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TopicAliasResource::collection(TopicAlias::with('topic')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicAliasRequest $request)
    {
        //
        $topicAlias = null;

        DB::beginTransaction();

        try {

            $topicAlias = TopicAlias::create($request->validated());

            $topicAlias->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return new TopicAliasResource(TopicAlias::findOrFail($topicAlias->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(TopicAlias $topicAlias)
    {
        //
        return new TopicAliasResource(TopicAlias::findOrFail($topicAlias->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicAliasRequest $request, TopicAlias $topicAlias)
    {
        //
        $topicAlias = TopicAlias::findOrFail($topicAlias->id);

        DB::beginTransaction();

        try {
            $topicAlias->update($request->validated());
            $topicAlias->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();

        return new TopicAliasResource($topicAlias);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopicAlias $topicAlias)
    {
        //

        DB::beginTransaction();

        try {
            $topicAlias->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 409);
        }

        DB::commit();

        return response()->json(null, 204);
    }
}
