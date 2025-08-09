<?php

// routes/web.php
use App\Http\Controllers\AuthController;
// routes/web.php
Route::get('/', function () {
    return view('welcome');  // Página con botones de Login y Registro
})->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function() {
    return view('tablero'); // Vista protegida para usuarios logueados
})->middleware('auth')->name('dashboard');

