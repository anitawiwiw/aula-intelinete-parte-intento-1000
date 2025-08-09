<?php

// routes/web.php
use App\Http\Controllers\AuthController;
// routes/web.php
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página protegida
Route::get('/dashboard', function () {
    return 'Bienvenido al dashboard';
})->middleware('auth');

// routes/web.php
Route::get('/dashboard', function() {
    return view('tablero');
})->middleware('auth')->name('dashboard');
