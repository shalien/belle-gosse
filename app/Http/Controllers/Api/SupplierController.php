<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Supplier\StoreSupplierRequest;
use App\Http\Requests\Api\Supplier\UpdateSupplierRequest;
use App\Http\Resources\PathResource;
use App\Http\Resources\ProviderTypeResource;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();

        return SupplierResource::collection($suppliers);
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
    public function store(StoreSupplierRequest $request)
    {
        //

        $supplier = Supplier::create($request->validated());

        return new SupplierResource($supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //

$supplier = Supplier::findOrFail($id);

return new SupplierResource($supplier);

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
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
        $supplier->update($request->validated());

        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return response()->json(null, 204);
    }

    public function showSupplierPaths(Supplier $supplier)
    {
        return PathResource::collection($supplier->paths);
    }

    public function showSupplierProviderType(Supplier $supplier)
    {
        return new ProviderTypeResource($supplier->providerType);
    }
}
