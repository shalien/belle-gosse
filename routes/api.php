<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\IgnoredHostController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\ProviderTypeController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UnmanagedRedditHostController;
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


Route::group(['excluded_middleware' => 'throttle:api'], function () {

    Route::controller(TopicController::class)->prefix('topics')->group(function () {
        Route::get('/', 'index');
        Route::get('/{topic}', 'show');
        Route::get('/{topic}/providers', 'showWithProviders');
        Route::put('/{topic}', 'update');
        Route::post('/', 'store');
        Route::delete('/{topic}', 'destroy');
    });

    Route::controller(ProviderController::class)->prefix('providers')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{provider}', 'show');
        Route::get('/topic/{topic}', 'byTopicId');
        Route::delete('/{provider}', 'destroy');
        Route::get('/{provider}/medias', 'medias');
    });

    Route::controller(MediaController::class)->prefix('medias')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{media}', 'destroy');
        Route::get('/{hash}', 'findByLink');

    });

    Route::controller(UnmanagedRedditHostController::class)->prefix('unmanagedreddithosts')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
    });

    Route::controller(IgnoredHostController::class)->prefix('ignoredhosts')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{ignored_host}', 'show');
        Route::delete('/{ignored_host}', 'destroy');
    });

    Route::controller(ProviderTypeController::class)->prefix('providertypes')->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{provider_type}', 'show');
        }
    );

    Route::controller(SourceController::class)->prefix('sources')->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{url}', 'findByLink');
        }
    );

    Route::controller(DestinationController::class)->prefix('destinations')->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
        }
    );
});
