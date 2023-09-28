<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [LoginController::class, "index"])->name('login');          //Ruta a la pagina de login
Route::post('/inicia-sesion', [ LoginController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('principal');

Route::resource('/libros', BookController::class)->names([
    'index' => 'libros.index', // Nombre para la ruta index
    'create' => 'libros.create', // Nombre para la ruta create
    'store' => 'libros.store', // Nombre para la ruta store
    'show' => 'libros.show', // Nombre para la ruta show
    'edit' => 'libros.edit', // Nombre para la ruta edit
    'update' => 'libros.update', // Nombre para la ruta update
    'destroy' => 'libros.destroy', // Nombre para la ruta destroy
]);

Route::resource('/administradores', AdministratorController::class)->names([
    'index' => 'administrador.index', // Nombre para la ruta index
    'create' => 'administrador.create', // Nombre para la ruta create
    'store' => 'administrador.store', // Nombre para la ruta store
    'show' => 'administrador.show', // Nombre para la ruta show
    'edit' => 'administrador.edit', // Nombre para la ruta edit
    'update' => 'administrador.update', // Nombre para la ruta update
    'destroy' => 'administrador.destroy', // Nombre para la ruta destroy
]);

Route::resource('/alumnos', StudentController::class)->names([
    'index' => 'alumno.index', // Nombre para la ruta index
    'create' => 'alumno.create', // Nombre para la ruta create
    'store' => 'alumno.store', // Nombre para la ruta store
    'show' => 'alumno.show', // Nombre para la ruta show
    'edit' => 'alumno.edit', // Nombre para la ruta edit
    'update' => 'alumno.update', // Nombre para la ruta update
    'destroy' => 'alumno.destroy', // Nombre para la ruta destroy
]);