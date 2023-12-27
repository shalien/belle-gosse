<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login', function () {
    abort(404);
});

Route::get('/collections', function () {
    return Redirect::away('https://collections.projetretro.io');
});

Route::middleware('auth:sanctum')->group(function () {

});
