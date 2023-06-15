<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Topic\StoreRequest;
use App\Http\Requests\Api\Topic\UpdateRequest;
use App\Models\Topic;
use Illuminate\{Contracts\Foundation\Application, Contracts\Routing\ResponseFactory, Http\Response, Support\Facades\DB};

class TopicController extends Controller
{
    //

    /**
     *
     * Show a Topic
     *
     * @param Topic $topic
     * @return string
     */
    public function show(Topic $topic)
    {
        return $topic->toJson();
    }

    public function showWithProviders(Topic $topic)
    {
        return $topic->load('providers')->toJson();
    }

    /***
     * Show all topic
     *
     * @return string
     */
    public function index()
    {
        return Topic::all()->toJson();
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
