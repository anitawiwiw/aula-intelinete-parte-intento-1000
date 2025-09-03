<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\RegistroDocenteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;


// Para docentes
Route::get('horarios/profes', [HorarioController::class, 'indexDeProfes'])
    ->name('horarios.index_de_profes');

Route::get('/', function () {
    return view('welcome');  // Página inicial con login/registro
})->name('welcome');

// ================== HOMES ==================
Route::get('/home_de_admins', function () {
    return view('admins.home_de_admins');
})->name('home_de_admins');

// Rutas docentes
Route::get('docentes/home', function () {
    return view('docentes.home_de_docentes');
})->name('home_de_docentes');

// Alias para compatibilidad con código viejo
Route::get('docentes/home', function () {
    return view('docentes.home_de_docentes');
})->name('docentes.home_de_docentes');
// <- este es el nombre correcto

 // 👈 sin el prefijo "docentes."

// ⚠️ Crea este archivo: resources/views/docentes/home_de_docentes.blade.php
// aunque sea vacío, así no rompe.
Route::get('materias/create_de_profes', [MateriaController::class, 'createDeProfes'])->name('materias.create_de_profes');
Route::post('materias/store_de_profes', [MateriaController::class, 'storeDeProfes'])->name('materias.store_de_profes');
// Mostrar el formulario de creación de reservas para docentes
Route::get('/reservas/create_de_docentes', [ReservaController::class, 'createDeDocentes'])
    ->name('reservas.create_de_docentes');


// Guardar la reserva creada por un docente
Route::post('/reservas/store_de_docentes', [ReservaController::class, 'storeDeDocentes'])
    ->name('reservas.store_de_docentes');

// Opcional: ruta al home de docentes (si no existe aún)
// ================== REGISTRO ==================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/docentes/create', [RegistroDocenteController::class, 'create'])->name('docentes.create');
Route::post('/docentes', [RegistroDocenteController::class, 'store'])->name('docentes.store');
// Rutas para horarios
// Mostrar selector de curso


Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
Route::post('/horarios', [HorarioController::class, 'seleccionar'])->name('horarios.seleccionar');

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
