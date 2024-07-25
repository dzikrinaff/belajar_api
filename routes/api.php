<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ActorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\FilmController;

use App\Http\Controllers\Api\LoginController;




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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class, 'authenticate']);
Route::post('logout',[LoginController::class, 'logout'])
    ->middleware('auth:sanctum');

//register
Route::post('register',[LoginController::class,'register']);

Route::middleware(['auth:sanctum'])->group(function () {
Route::resource('kategori', KategoriController::class);
Route::resource('actor', ActorController::class);
Route::resource('genre', GenreController::class);
Route::resource('film', FilmController::class);

});
