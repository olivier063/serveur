<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AnnoncesController;
use App\Http\Controllers\UserController;

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


Route::controller(AnnoncesController::class)->group(function() {
    route::get('annonces', 'index');
    route::get('annonces/{annonce}', 'show');
    route::Post('annonces','store');
    route::put('annonces/{id}', 'update');
    route::delete('annonces/{id}', 'destroy');
});

Route::controller(MessageController::class)->group(function() {
    route::get('message', 'index');
    route::get('message/{message}', 'show');
    route::post('message', 'store');
    route::put('message/{id}', 'update');
    route::delete('message/{id}', 'destroy');
});

Route::controller(UserController::class)->group(function() {
    route::get('user', 'index')->name('user.index');
    route::get('user/{user}', 'show')->name('user.show');
    route::post('user', 'store')->name('user.store');
    route::put('user/{id}', 'update')->name('user.update');
    route::delete('user/{id}', 'destroy')->name('user.destroy');
});

