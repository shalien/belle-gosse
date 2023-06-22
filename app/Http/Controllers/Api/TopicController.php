<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Topic\StoreTopicRequest;
use App\Http\Requests\Api\Topic\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        //
        return TopicResource::collection(Topic::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request): JsonResponse|TopicResource
    {
        $topic = null;

        try {
            DB::beginTransaction();

            $topic = Topic::create($request->validated());

            $topic->save();

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new TopicResource($topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic): TopicResource
    {
        //
        return new TopicResource($topic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic): JsonResponse|TopicResource
    {

        try {
            DB::beginTransaction();
            $topic->updateOrFail($request->validated());

            $topic->save();
        } catch (Throwable $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new TopicResource($topic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic): JsonResponse
    {
        //

        return $topic->delete()
            ? response()->json(null, Response::HTTP_NO_CONTENT)
            : response()->json(['error' => 'Error deleting'], Response::HTTP_CONFLICT);
    }
}
