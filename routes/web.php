<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SensorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta principal - Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rutas para Estaciones
Route::resource('stations', StationController::class)->only(['index', 'create', 'store']);

// Rutas para Sensores
Route::resource('sensors', SensorController::class)->only(['index', 'create', 'store']);

// Tus rutas adicionales (si las necesitas)
Route::get('/tabla', function () {
    return view('tabla');
})->name('tabla');

Route::get('/Registro', function () {
    return view('Registro');
})->name('Registro');