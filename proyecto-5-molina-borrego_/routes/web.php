<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\BBDDController;
use App\Http\Controllers\EloquentController;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', [PaginaController::class, 'inicio'])->name('inicio');
Route::get('/ver', [BBDDController::class, 'ver'])->name('ver');
Route::get('/añadir', [BBDDController::class, 'añadir'])->name('añadir');
Route::get('/sobre-nosotros', [PaginaController::class, 'sobreNosotros'])->name('sobre.nosotros');

Route::get('/editar-videojuego', [CRUDController::class, 'index'])->name('editar.videojuego');
Route::get('/editar-videojuego/{id}', [CRUDController::class, 'editar'])->name('editar.videojuego.form');
Route::put('/editar-videojuego/{id}', [CRUDController::class, 'actualizar'])->name('editar.videojuego.confirmado');

Route::get('/borrar-videojuego', [CRUDController::class, 'seleccionarBorrar'])->name('borrar.seleccionar');
Route::delete('/borrar-videojuego', [CRUDController::class, 'borrar'])->name('borrar.confirmado');

Route::get('/iniciar-sesion', [AuthController::class, 'showLoginForm'])->name('iniciar.sesion');
Route::post('/iniciar-sesion', [AuthController::class, 'login'])->name('iniciar.sesion.submit');

Route::get('/registrar', [AuthController::class, 'showRegistrationForm'])->name('registrar');
Route::post('/registrar', [AuthController::class, 'register'])->name('registrar.submit');

Route::post('/guardar-videojuego', [BBDDController::class, 'guardar'])->name('guardar.videojuego');
Route::get('/generos', [EloquentController::class, 'generos'])->name('generos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/videojuegos/{id}/valorar', [CRUDController::class, 'valorar'])->name('videojuego.valorar');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');