<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\RegistroDocenteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;


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
// Rutas para horarios
// Mostrar selector de curso
Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');

// Procesar selección de curso
Route::get('/horarios/seleccionar', [HorarioController::class, 'seleccionar'])->name('horarios.select');

// Ver horario específico
Route::get('/horarios/{anio}/{division}/{turno}', [HorarioController::class, 'show'])
    ->where([
        'anio' => '[1-5]',
        'division' => '[A-C]',
        'turno' => 'manana|tarde'
    ])
    ->name('horarios.show');

// ================== LOGIN / LOGOUT ==================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================== RESERVAS ==================
Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::resource('aulas', AulaController::class);
Route::resource('materias', MateriaController::class);
// Panel de docentes (listado, ver, admin gestiona)
Route::resource('docentes', RegistroDocenteController::class)->except(['show']);
// ================== RUTAS EXTRA PARA DOCENTES (no admin) ==================
Route::get('docentes/create2', [RegistroDocenteController::class, 'create2'])->name('docentes.create2');
Route::post('docentes/store2', [RegistroDocenteController::class, 'store2'])->name('docentes.store2');
Route::get('/docentes/{docente}/edit', [RegistroDocenteController::class, 'edit'])->name('docentes.edit');
Route::patch('/docentes/{docente}', [RegistroDocenteController::class, 'update'])->name('docentes.update');
// ================== RUTAS RESERVAS (auth) ==================

Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::patch('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
// web.php
Route::get('/verificar-reserva', [ReservaController::class, 'verificarDisponibilidad'])->name('reservas.verificar');

// ================== FALLBACK ==================
Route::fallback(function () {
    return view('errors.404'); // asegurate de tener resources/views/errors/404.blade.php
});
