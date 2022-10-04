<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Topic\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    //

    public function show() {
        return Topic::all()->toJson();
    }

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

    }


}
