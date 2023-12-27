<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Search\StoreSearchRequest;
use App\Http\Requests\Api\Search\UpdateSearchRequest;
use App\Http\Resources\PathResource;
use App\Http\Resources\SearchResource;
use App\Http\Resources\TopicResource;
use App\Models\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return SearchResource::collection(Search::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSearchRequest $request)
    {
        //
        $validated = $request->validated();

        $search = Search::create($validated);
        $search->path()->associate($request->path_id);
        $search->topic()->associate($request->topic_id);
        $search->supplier()->associate($request->supplier_id);
        $search->save();

        return new SearchResource($search);
    }

    /**
     * Display the specified resource.
     */
    public function show(Search $search)
    {
        //
        return new SearchResource($search);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSearchRequest $request, Search $search)
    {
        //
        $validated = $request->validated();

        $search->update($validated);
        $search->path()->associate($request->path_id);
        $search->topic()->associate($request->topic_id);
        $search->supplier()->associate($request->supplier_id);
        $search->save();

        return new SearchResource($search);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Search $search)
    {
        //
        $search->delete();

        return response()->noContent();
    }

    public function showSearchPath(Search $search)
    {
        return new PathResource($search->path);
    }

    public function showSearchTopic(Search $search)
    {
        return new TopicResource($search->topic);
    }

    public function showSearchSupplier(Search $search)
    {
        return new TopicResource($search->supplier);
    }
}
