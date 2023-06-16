<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Topic\StoreRequest;
use App\Http\Requests\Api\Topic\UpdateRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\{Contracts\Foundation\Application,
    Contracts\Routing\ResponseFactory,
    Http\Resources\Json\AnonymousResourceCollection,
    Http\Response,
    Support\Facades\DB};

class TopicController extends Controller
{
    //

    /**
     *
     * Show a Topic
     *
     * @param Topic $topic
     * @return AnonymousResourceCollection
     */
    public function show(Topic $topic)
    {
        return new TopicResource::($topic);
    }

    public function showWithProviders(Topic $topic)
    {
        return $topic->load('providers')->toJson();
    }

    /***
     * Show all topic
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TopicResource::collection(Topic::all());
    }

    /***
     *
     * Create a new topic in the database
     *
     * @param StoreRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreRequest $request)
    {

        $topic = null;

        try {
            DB::beginTransaction();

            $topic = Topic::create($request->validated());

            $topic->save();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($request, $e);
        }

        DB::commit();

        return response(json_encode(['id' => $topic->id]), 200);
    }

    /**
     * @param UpdateRequest $request
     * @param Topic $topic
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateRequest $request, Topic $topic)
    {

        try {
            DB::beginTransaction();;

            $topic->update($request->validated());
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response(null, 200);
    }


}
