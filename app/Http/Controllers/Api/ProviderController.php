<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\DeleteRequest;
use App\Http\Requests\Api\Provider\StoreRequest;
use App\Models\Provider;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    //

    public function index() {

        $providers = Provider::all();

        return JsonResponse::fromJsonString(json_encode($providers));
    }

    public function byTopicId(Topic $topic) {
        $providers = Provider::all()->where('topic_id' ,'=', $topic->id);

        return json_encode($providers);
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


    public function delete(Provider $provider) {


        try {
            DB::beginTransaction();

            $provider->delete();

        }catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response();

    }
}
