<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\RegistroDocenteController;



Route::get('/', function () {
    return view('welcome');  // Página inicial con login/registro
})->name('welcome');

// ================== HOMES ==================
Route::get('/home_de_admins', function () {
    return view('admins.home_de_admins');
})->name('home_de_admins');

Route::get('/home_de_docentes', function () {
    return view('docentes.home_de_docentes');
})->name('home_de_docentes'); 
// ⚠️ Crea este archivo: resources/views/docentes/home_de_docentes.blade.php
// aunque sea vacío, así no rompe.

// ================== REGISTRO ==================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/docentes/create', [RegistroDocenteController::class, 'create'])->name('docentes.create');
Route::post('/docentes', [RegistroDocenteController::class, 'store'])->name('docentes.store');

// ================== LOGIN / LOGOUT ==================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================== RESERVAS ==================
Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::resource('aulas', AulaController::class);
// ================== FALLBACK ==================
Route::fallback(function () {
    return view('errors.404'); // asegurate de tener resources/views/errors/404.blade.php
});
