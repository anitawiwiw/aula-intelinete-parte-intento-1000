<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

// Ruta API para sensores (POST)
Route::post('/sensores', [SensorController::class, 'store']);