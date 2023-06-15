<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Source\FindByLinkRequest;
use App\Http\Requests\Api\Source\StoreRequest;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        //
        return Source::all()->toJson();
    }


    /**
     * @param FindByLinkRequest $request
     * @return string
     */
    public function findByLink(FindByLinkRequest $request): string
    {
        $url = urldecode($request->validated(['url']));

        $source = Source::all()->where('link', 'like', "%{$url}%")->first;

        return $source->toJson();
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

    public function getByLink($link)
    {

        $source = Source::all()->where('link', '=', urldecode($link))->first();

        if ($source == null) {
            return response(status: 404);
        } else {
            return $source->toJson();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
