<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Topic\UpdateRequest;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Topic\StoreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
    public function show(Topic $topic) {
        return $topic->toJson();
    }

    /***
     * Show all topic
     *
     * @return string
     */
    public function index() {
        return Topic::all()->toJson();
    }

    /***
     *
     * Create a new topic in the database
     *
     * @param StoreRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreRequest $request) {

        try {
            DB::beginTransaction();

            $topic = Topic::create($request->validated());

            $topic->save();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($request, $e);
        }

        DB::commit();

        return response(null, 200);
    }

    /**
     * @param UpdateRequest $request
     * @param Topic $topic
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateRequest $request, Topic $topic) {

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
