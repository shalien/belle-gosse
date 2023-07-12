<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Source\StoreSourceRequest;
use App\Http\Requests\Api\Source\UpdateSourceRequest;
use App\Http\Resources\SourceResource;
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

    public function showByLink(Request $request): SourceResource
    {
        $url = base64_decode($request['url']);

        return new SourceResource(Source::where('link', '=', $url)->firstOrFail());
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

            $source->provider()->associate($request->validated()['provider_id']);

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
     * @param UpdateSourceRequest $request
     * @param Source $source
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
     * @param Source $source
     * @return JsonResponse
     */
    public function destroy(Source $source)
    {
        //
        return $source->delete() ?
            response()->json(['message' => 'Source deleted successfully'], Response::HTTP_OK) :
            response()->json(['message' => 'Source not deleted'], Response::HTTP_CONFLICT);
    }
}
