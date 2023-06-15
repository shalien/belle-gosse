<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\FindByLinkRequest;
use App\Http\Requests\Api\Media\StoreRequest;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    //

    public function index()
    {
        return json_encode(Media::all());
    }


    public function store(StoreRequest $request)
    {
        $media = null;

        try {
            DB::beginTransaction();

            $media = Media::create($request->validated());

            $media->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response(json_encode(['id' => $media->id]));
    }

    /**
     * @param FindByLinkRequest $request
     * @return string
     */
    public function findByLink(FindByLinkRequest $request): string
    {
        $url = urldecode($request->validated(['url']));

        $media = Media::all()->where('link', 'like', "%{$url}%")->first;

        return $media->toJson();
    }
}
