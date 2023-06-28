<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Destination\StoreDestinationRequest;
use App\Http\Requests\Api\Destination\UpdateDestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        //
        return DestinationResource::collection(Destination::with('medias')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request): DestinationResource|JsonResponse
    {
        //

        $destination = null;

        try {
            DB::beginTransaction();

            $destination = Destination::create($request->validated());

            $destination->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new DestinationResource($destination);
    }

    /**
     * Display the specified resource.
     *
     * @param Destination $destination
     * @return DestinationResource
     */
    public function show(Destination $destination): DestinationResource
    {
        //
        return new DestinationResource(Destination::findOrFail($destination->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination): DestinationResource|JsonResponse
    {
        //
        $destination = Destination::findOrFail($destination->id);

        try {
            DB::beginTransaction();

            $destination = $destination->update($request->validated());

            $destination->save();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }

        DB::commit();

        return new DestinationResource(Destination::findOrFail($destination->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination): JsonResponse
    {
        //
        return $destination->delete()
            ? response()->json(null, ResponseAlias::HTTP_NO_CONTENT)
            : response()->json(['error' => 'Error deleting'], ResponseAlias::HTTP_CONFLICT);
    }
}
