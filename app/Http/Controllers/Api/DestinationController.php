<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Destination\StoreRequest;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        //

      return DestinationResource::collection(Destination::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        //

        $destination = null;

        try {
            DB::beginTransaction();

            $destination = Destination::create($request->validated());

            $destination->save();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        DB::commit();

        return response(json_encode(['id' => $destination->id]), 200);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DestinationResource
     */
    public function show($id)
    {
        //

        return new DestinationResource(Destination::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
