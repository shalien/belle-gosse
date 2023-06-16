<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Source\FindByLinkRequest;
use App\Http\Requests\Api\Source\StoreRequest;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //
        return SourceResource::collection(Source::all());
    }


    /**
     * @param Request $request
     * @return SourceResource
     */
    public function findByLink(Request $request): SourceResource
    {
        $url = base64_decode($request['url']);

        return new SourceResource(Source::where('link', '=', $url)->firstOrFail());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //

        $source = null;

        try {
            DB::beginTransaction();

            $source = Source::create($request->validated());

            $source->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response(json_encode($e));
        }

        DB::commit();

        return response(json_encode(['id' => $source->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
