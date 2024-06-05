<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EnumController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\JobMatchController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\VacancyController;
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
    Route::get('academic-level', [EnumController::class, 'academicLevel']);
    Route::get('experience-level', [EnumController::class, 'experienceLevel']);
    Route::get('technology-type', [EnumController::class, 'technologyType']);
    Route::get('technologies', [TechnologyController::class, 'index']);

    Route::get('developer/random', [DeveloperController::class, 'random']);
    Route::get('vacancies/random', [VacancyController::class, 'random']);
    Route::get('vacancies/query', [VacancyController::class, 'query']);
    Route::get('developer/{id}', [DeveloperController::class, 'show']);
    Route::get('developer', [DeveloperController::class, 'index']);
    Route::get('company/{id}', [CompanyController::class, 'show']);
});

// Metodos que requieren autenticacion via token.
// headers: { Authorization: `Bearer 9|oDYcViwIo5KjRpG8BWLfL6kQmiXMtwRI3hTN9Z8B5371571d` }

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('user', [AuthController::class, 'user']);
    Route::put('user', [AuthController::class, 'update']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('job-matches', [JobMatchController::class, 'index']);
    Route::post('job-matches/refresh', [JobMatchController::class, 'refreshMatches']);

    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('experiences', ExperienceController::class);
    Route::apiResource('education', EducationController::class);
    Route::apiResource('vacancies', VacancyController::class);
});
