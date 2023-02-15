<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AnnoncesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LikeAnnonceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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


Route::controller(AnnoncesController::class)->group(function () {
    route::get('annonces', 'index');
    route::get('annonces2', 'index2');
    route::get('annonces/{annonce}', 'show');
    // route::put('annonces/{id}', 'update');
});


Route::middleware(["auth:sanctum"])->group(function () {
    Route::controller(UserController::class)->group(function () {
        route::get('user', 'index')->name('user.index');
        route::get('me', 'me')->name('user.me');
        route::get('user/{user}', 'show')->name('user.show');
        route::post('user', 'store')->name('user.store');
        route::put('user/{id}', 'update')->name('user.update');
        route::delete('user/{id}', 'destroy')->name('user.destroy');
    });
    Route::controller(AnnoncesController::class)->group(function () {
        //pour montrer que les annonces de l'utilisateur :
        route::get('myannonces/{user}', 'showMyAnnonce');
        route::Post('annonces', 'store');
        route::delete('annonces/{id}', 'destroy');       
        route::put('annonces/{id}', 'update');
    });
    Route::controller(MessageController::class)->group(function () {
        route::get('message', 'index');
        route::get('message/{message}', 'show');
        route::post('message', 'store');
        route::put('message/{id}', 'update');
        route::delete('message/{id}', 'destroy');
    });
    //dans les accolades c'est l'id
    Route::controller(LikeAnnonceController::class)->group(function () {
        route::post('like-annonce/{user}/annonce/{annonce}', 'store');
    });
});


Route::controller(AuthenticationController::class)->group(function () {
    route::post('create-account', 'createAccount')->name('authentication.create');
});

Route::controller(LoginController::class)->group(function () {
    route::post('Login', 'login')->name('login.login');
});


//Pas besoin de Route ou de LogoutController dans le back, tout se gere dans le front avec le localStorage
// Route::Controller(LogoutController::class)->group(function(){
//     route::post('Logout', 'logout')->name('logout.logout');
// });
