<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirlinesController;
use App\Http\Controllers\AirportsController;
use App\Http\Controllers\UserController;

Route::group( ['prefix' => 'auth'] , function () {
    Route::post('login', [AuthController::class, 'login']);
    
    Route::group( ['middleware' => 'auth:api'] , function() {
        Route::get('logout', [AuthController::class, 'logout']);
    });    
});
Route::group( ['middleware' => 'auth:api'] , function() {
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::resource('users', UserController::class);
    Route::resource('flights', FlightsController::class);
    Route::resource('airports', AirportsController::class);
    Route::resource('airlines', AirlinesController::class);
});
