<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ApiKeyController;

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

// routes/web.php


// Route vers formulaire pour api
Route::get('/api', [UserController::class, 'api'])->name('api.index');


Route::get('/', [ApiKeyController::class, 'index'])->name('tracks.index');
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('playlist', PlaylistController::class);

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/tracks/create', [TrackController::class, 'create'])->name('tracks.create');
        Route::post('/tracks', [TrackController::class, 'store'])->name('tracks.store');
        Route::get('/tracks/{track}/edit', [TrackController::class, 'edit'])->name('tracks.edit');
        Route::put('/tracks/{track}', [TrackController::class, 'update'])->name('tracks.update');
        Route::delete('/tracks/{track}', [TrackController::class, 'destroy'])->name('tracks.destroy');
    });
});
