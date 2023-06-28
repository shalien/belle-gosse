<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\IgnoredHostController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\ProviderLinkController;
use App\Http\Controllers\Api\ProviderTypeController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\TopicAliasController;
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

    Route::resources([
        'topics' => TopicController::class,
        'providers' => ProviderController::class,
        'providerlinks' => ProviderLinkController::class,
        'medias' => MediaController::class,
        'unmanagedreddithosts' => UnmanagedRedditHostController::class,
        'ignoredhosts' => IgnoredHostController::class,
        'providertypes' => ProviderTypeController::class,
        'sources' => SourceController::class,
        'destinations' => DestinationController::class,
        'topicalias' => TopicAliasController::class,
    ]);

    Route::controller(TopicController::class)->prefix('topics')->group(function () {
        Route::get('/{topic}/providers', 'showWithProviders');

    });

    Route::controller(ProviderController::class)->prefix('providers')->group(function () {
        Route::get('/topic/{topic}', 'byTopicId');
        Route::get('/{provider}/medias', 'medias');
    });

    Route::controller(MediaController::class)->prefix('medias')->group(function () {
        Route::get('/link/{url}', 'showByLink');

    });

    Route::controller(SourceController::class)->prefix('sources')->group(
        function () {
            Route::get('/link/{url}', 'showByLink');
        }
    );
});
