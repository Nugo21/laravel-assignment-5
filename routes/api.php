<?php

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
//
//Route::middleware('auth:api')->get('/api/v1/todo-list',)-name('todoIndex');
Route::get('/v1/playlists', [\App\Http\Controllers\PlayListController::class, 'getPlayListByUserId']);
Route::get('/v1/playlists/musics', [\App\Http\Controllers\PlayListController::class, 'getMusicsByUserId']);

Route::post('/v1/playlists', [\App\Http\Controllers\PlayListController::class, 'index']);
Route::post('/v1/playlists/{id}', [\App\Http\Controllers\PlayListController::class, 'addMusicToPlayList']);
Route::delete('/v1/playlists/music/{musicId}', [\App\Http\Controllers\PlayListController::class, 'destroyMusic']);
Route::delete('/v1/playlists/{playlistId}', [\App\Http\Controllers\PlayListController::class, 'destroy']);
//Route::put('v1/todo-lists/{id}', [\App\Http\Controllers\PlayListController::class, 'update']);
//Route::delete('v1/todo-lists/{id}', [\App\Http\Controllers\PlayListController::class, 'destroy']);
//Route::get('v1/todo-lists/{id}', [\App\Http\Controllers\PlayListController::class, 'getTodo']);
//Route::get('v1/todo-lists', [\App\Http\Controllers\PlayListController::class, 'getAll']);
