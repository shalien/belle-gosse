<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login', function () {
    abort(404);
});

Route::middleware('auth:sanctum')->group(function () {

});
