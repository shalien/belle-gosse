<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Path\StorePathRequest;
use App\Http\Requests\Api\Path\UpdatePathRequest;
use App\Http\Resources\PathResource;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SourceResource;
use App\Models\Path;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PathResource::collection(Path::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePathRequest $request): PathResource|JsonResponse
    {
        //

        $path = null;

        try {
            DB::beginTransaction();

            $path = Path::create($request->validated());

            $path->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);

        }

        DB::commit();

        return new PathResource($path);

    }

    /**
     * Display the specified resource.
     */
    public function show(Path $path)
    {
        return new PathResource($path);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePathRequest $request, Path $path)
    {
        //

        try {
            DB::beginTransaction();
            $path->update($request->validated());
            $path->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new PathResource($path);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //

        $path = Path::findOrFail($id);

        $path->delete();

        return response()->json(['message' => 'Path deleted successfully'], Response::HTTP_NO_CONTENT);
    }

    public function showPathSources(Path $path)
    {
        //
        return SourceResource::collection($path->sources);
    }

    public function showPathSearches(Path $path)
    {
        //
        return SearchResource::collection($path->searches);
    }
}
