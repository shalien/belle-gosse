<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\StoreRequest;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    //

    public function index() {

        $providers = Provider::all();

        return JsonResponse::fromJsonString(json_encode($providers));
    }

    public function store(StoreRequest $request)
    {

    }
}
