<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\StoreMediaRequest;
use App\Http\Requests\Api\Media\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Destination;
use App\Models\Media;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    //

    public function index(): AnonymousResourceCollection
    {
        return MediaResource::collection(Media::with('source', 'destination')->get());
    }

    public function show(Media $media): MediaResource
    {
        return new MediaResource(Media::findOrFail($media->id));
    }

    public function showByDestination(Destination $destination)
    {
        return MediaResource::collection(Media::where('destination_id', '=', $destination->id)->get());
    }

    public function showBySource(Source $source)
    {
        return MediaResource::collection(Media::where('source_id', '=', $source->id)->get());
    }

    public function store(StoreMediaRequest $request)
    {

        $media = null;

        try {
            DB::beginTransaction();

            $media = Media::create($request->validated());

            $media->source()->associate($request->validated()['source_id']);
            $media->destination()->associate($request->validated()['destination_id']);

            $media->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new MediaResource($media);
    }

    public function update(UpdateMediaRequest $request, Media $media)
    {

        $media = Media::findOrFail($media->id);

        try {
            DB::beginTransaction();

            $media = $media->update($request->validated());

            $media->source()->associate($request->validated()['source_id']);
            $media->destination()->associate($request->validated()['destination_id']);

            $media->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new MediaResource($media);
    }

    public function showByLink(Request $request): MediaResource
    {
        $url = base64_decode($request['url']);

        return new MediaResource(Media::where('link', '=', $url)->firstOrFail());
    }
}
