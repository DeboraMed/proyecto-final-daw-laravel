<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Metodos que no requieren autenticacion

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);


});

// Metodos que requieren autenticacion via token.
// headers: { Authorization: `Bearer 9|oDYcViwIo5KjRpG8BWLfL6kQmiXMtwRI3hTN9Z8B5371571d` }

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('user', [AuthController::class, 'user']);
    Route::get('logout', [AuthController::class, 'logout']);
});
