<?php

namespace App\Http\Controllers\_OLD;

use App\Http\Controllers\Controller;
use App\Http\Requests\_OLD\Channel\StoreChannelRequest;
use App\Http\Resources\_OLD\ChannelResource;
use App\Models\_OLD\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ChannelResource::collection(Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChannelRequest $request)
    {
        //

        $channel = Channel::create($request->validated());

        return new ChannelResource($channel);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
