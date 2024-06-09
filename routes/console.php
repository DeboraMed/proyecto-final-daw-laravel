<?php

use App\Http\Controllers\JobMatchController;
use Illuminate\Support\Facades\Schedule;

# Configuración para que el matchmaking se ejecute cada 5 minutos.
Schedule::call(function () {
    JobMatchController::refreshMatches();
})->everyFiveMinutes();
