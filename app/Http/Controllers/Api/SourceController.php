<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Source\StoreSourceRequest;
use App\Http\Requests\Api\Source\UpdateSourceRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PathResource;
use App\Http\Resources\SourceResource;
use App\Models\Destination;
use App\Models\Source;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return SourceResource::collection(Source::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return SourceResource|JsonResponse
     */
    public function store(StoreSourceRequest $request)
    {
        //
        $source = null;

        try {
            DB::beginTransaction();
            $source = Source::create($request->validated());

            $source->path()->associate($request->validated()['path_id']);

            $source->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new SourceResource($source);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SourceResource
     */
    public function show(Source $source)
    {
        //
        return new SourceResource(Source::findOrFail($source->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return SourceResource|JsonResponse
     */
    public function update(UpdateSourceRequest $request, Source $source)
    {
        //
        try {
            DB::beginTransaction();
            $source = Source::findOrFail($source->id);
            $source->update($request->validated());
            $source->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new SourceResource(Source::findOrFail($source->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(Source $source)
    {
        //
        return $source->delete() ?
            response()->json(['message' => 'Source deleted successfully'], Response::HTTP_OK) :
            response()->json(['message' => 'Source not deleted'], Response::HTTP_CONFLICT);
    }


    public function showByLink(Request $request): SourceResource
    {
        $url = base64_decode($request['url']);

        return new SourceResource(Source::where('link', '=', $url)->firstOrFail());
    }

    public function showWithMedias(Source $source)
    {
        return MediaResource::collection($source->medias()->get());
    }

    public function showByFilename(Request $request): SourceResource
    {
        $filename = $request['filename'];

        $destination = Destination::where('filename', 'LIKE', '%' . $filename . '%')->firstOrFail();

        $media = $destination->medias->first();

        $source = $media->source;

        return new SourceResource($source);
    }

    public function showSourceQuery(Source $source)
    {

        return new PathResource($source->queryy());
    }
}
