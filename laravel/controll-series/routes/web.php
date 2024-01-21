<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::resource('/series', SeriesController::class)
//     ->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
Route::resource('/series', SeriesController::class)
    ->except(['show']);

// Route::controller(SeriesController::class)->group(function () {
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/new', 'create')->name('series.create');
//     Route::post('/series/save', 'store')->name('series.store');
// });

Route::middleware(['authenticator'])->group(function () {
    Route::get('/', function () {
        return redirect('/series');
    });
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
        ->name('seasons.index');
    
    Route::get('/season/{season}/episodes', [EpisodesController::class, 'index'])
        ->name('episodes.index');
    Route::post('/season/{season}/episodes', [EpisodesController::class, 'update'])
        ->name('episodes.update');
});



Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->name('signin');

Route::get('/register', [UsersController::class, 'create'])
    ->name('users.create');
Route::post('/register', [UsersController::class, 'store'])
    ->name('users.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->name('logout');    
