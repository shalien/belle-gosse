<?php

use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(TopicController::class)->prefix('topics')->group(function () {
           Route::get('/', 'index');
           Route::get('/{topic}', 'show');
           Route::put('/{topic}', 'update');
           Route::post('/', 'store');
});

Route::controller(ProviderController::class)->prefix('providers')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});

Route::controller(MediaController::class)->prefix('medias')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});
