<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Metodos que no requieren autenticacion

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('contract-type', [EnumController::class, 'contractType']);
    Route::get('schedule', [EnumController::class, 'schedule']);
    Route::get('specialization', [EnumController::class, 'specialization']);
    Route::get('work-mode', [EnumController::class, 'workMode']);
});

// Metodos que requieren autenticacion via token.
// headers: { Authorization: `Bearer 9|oDYcViwIo5KjRpG8BWLfL6kQmiXMtwRI3hTN9Z8B5371571d` }

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('user', [AuthController::class, 'user']);
    Route::get('logout', [AuthController::class, 'logout']);
});
