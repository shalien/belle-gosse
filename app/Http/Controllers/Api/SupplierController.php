<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Supplier\StoreSupplierRequest;
use App\Http\Requests\Api\Supplier\UpdateSupplierRequest;
use App\Http\Resources\ProviderTypeResource;
use App\Http\Resources\SearchResource;
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
    public function show(Supplier $supplier)
    {

        return new SupplierResource($supplier);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
        $supplier->update($request->validated());
        $supplier->save();

        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();

        return response()->json(null, 204);
    }

    public function showSupplierProviderType(Supplier $supplier)
    {
        return new ProviderTypeResource($supplier->providerType);
    }

    public function showSupplierSearch(Supplier $supplier)
    {
        return new SearchResource($supplier->search);
    }
}
