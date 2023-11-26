<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\PathController;
use App\Http\Controllers\Api\ProviderTypeController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')
    ->withoutMiddleware('throttle:api')
    ->group(function () {

        Route::resources([
            'topics' => TopicController::class,
            'medias' => MediaController::class,
            'provider_types' => ProviderTypeController::class,
            'sources' => SourceController::class,
            'destinations' => DestinationController::class,
            'users' => UserController::class,
            'paths' => PathController::class,
        ]);

        Route::controller(TopicController::class)->prefix('topics')->group(function () {
            Route::get('/{topic}/providers', 'showWithProviders');
        });


        Route::controller(MediaController::class)->prefix('medias')->group(function () {
            Route::get('/link/{url}', 'showByLink');
            Route::get('/destination/{destination}', 'showByDestination');
            Route::get('/source/{source}', 'showBySource');

        });

        Route::controller(SourceController::class)->prefix('sources')->group(
            function () {
                Route::get('/link/{url}', 'showByLink');
                Route::get('/{source}/medias', 'showWithMedias');
                Route::get('/destination/{filename}', 'showByFilename');
                Route::get('/{source}/query', 'showSourceQuery');
            }
        );

    });
