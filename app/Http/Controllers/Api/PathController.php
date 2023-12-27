<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Path\StorePathRequest;
use App\Http\Requests\Api\Path\UpdatePathRequest;
use App\Http\Resources\PathResource;
use App\Http\Resources\SourceResource;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\TopicResource;
use App\Models\Path;
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
    public function store(StorePathRequest $request)
    {
        //

        $path = null;

        try {
            DB::beginTransaction();

            $path = Path::create($request->validated());

            $path->save();
        } catch (\Exception $e) {
            DB::rollBack();

        }

        DB::commit();

        return new PathResource(Path::findOrfail($path->id));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $path = Path::findOrFail($id);

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
            $path = Path::findOrFail($path->id);
            $path->update($request->validated());
            $path->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new PathResource(Path::findOrFail($path->id));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $path = Path::findOrFail($id);

        $path->delete();
    }

    public function showPathSources(Path $path)
    {
        //
        return SourceResource::collection(Path::findOrFail($path->id)->sources);
    }

    public function showPathTopics(Path $path)
    {
        //
        return TopicResource::collection(Path::findOrFail($path->id)->topics);
    }

    public function showPathSuppliers(Path $path)
    {
        //
        return SupplierResource::collection(Path::findOrFail($path->id)->suppliers);
    }

    public function showByContent(string $content)
    {
        return new PathResource(Path::where('content', $content)->firstOrFail());
    }
}
