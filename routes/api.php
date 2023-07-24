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
        'provider_links' => ProviderLinkController::class,
        'medias' => MediaController::class,
        'unmanaged_hosts' => UnmanagedRedditHostController::class,
        'ignored_hosts' => IgnoredHostController::class,
        'provider_types' => ProviderTypeController::class,
        'sources' => SourceController::class,
        'destinations' => DestinationController::class,
        'topic_aliases' => TopicAliasController::class,
    ]);

    Route::controller(TopicController::class)->prefix('topics')->group(function () {
        Route::get('/{topic}/providers', 'showWithProviders');
        Route::get('/{topic}/alias', 'showWithAliases');
    });

    Route::controller(ProviderController::class)->prefix('providers')->group(function () {
        Route::get('/{provider}/topic', 'showWithTopic');
        Route::get('/{provider}/links', 'showWithLinks');
        Route::get('/{provider}/sources', 'showSources');
    });

    Route::controller(MediaController::class)->prefix('medias')->group(function () {
        Route::get('/link/{url}', 'showByLink');
        Route::get('/{media}/source', 'showWithSources');
        Route::get('/{media}/destination', 'showWithDestinations');

    });

    Route::controller(SourceController::class)->prefix('sources')->group(
        function () {
            Route::get('/link/{url}', 'showByLink');
            Route::get('/{source}/provider', 'showWithProvider');
        }
    );

    Route::controller(ProviderLinkController::class)->prefix('provider_links')->group(
        function () {
            Route::get('/link/{url}', 'showByLink');
            Route::get('/{provider_link}/providers', 'showWithProviders');

        }
    );
});
