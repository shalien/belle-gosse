<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\FindByLinkRequest;
use App\Http\Requests\Api\Media\StoreRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    //

    public function index()
    {
        return MediaResource::collection(Media::all());
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
     * @param Request $request
     * @return MediaResource
     */
    public function findByLink(Request $request): MediaResource
    {
        $url = base64_decode($request['hash']);

        return new MediaResource(Media::where('link', '=', $url)->firstOrFail());
    }
}
