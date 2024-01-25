<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SeriesController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    // series
    Route::apiResource('/series', SeriesController::class);
    Route::get('/series/{series}/seasons', [SeriesController::class, 'getSeasons']);
    Route::get('/series/{series}/episodes', [SeriesController::class, 'getEpisodes']);

    // episodes
    Route::patch('/episodes/{episode}', [EpisodesController::class, 'update']);

    // upload image
    Route::post('/image/upload', [ImageController::class, 'store']);
});


Route::post('/login', [LoginController::class, 'store']);
