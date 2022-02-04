<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirlinesController;
use App\Http\Controllers\AirportsController;
use App\Http\Controllers\UserController;

//Route::post('/logout', [AuthController::class, 'logout']);
Route::group( ['prefix' => 'auth'] , function () {
    Route::post('login', [AuthController::class, 'login']);
    
    Route::group( ['middleware' => 'auth:api'] , function() {
        Route::post('logout', function (Request $request) {
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);
        });
    });    
});

Route::group( ['middleware' => 'auth:api'] , function() {
    Route::get('/user', [UserController::class, 'show']);

    
    Route::group( ['middleware' => 'role:admin'], function(){
        Route::resource('users', UserController::class);
        Route::resource('flights', FlightsController::class);
        Route::resource('airports', AirportsController::class);
        Route::resource('airlines', AirlinesController::class);
    });
    
    Route::group( ['middleware' => 'role:operations'], function(){
        Route::get('/flights', [FlightsController::class, 'index']);
        Route::get('/airports', [AirportsController::class, 'index']);
        Route::get('/airlines', [AirlinesController::class, 'index']);
    });
});
