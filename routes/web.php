<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;

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
Route::post('/filtro/{universidad}', [DashboardController::class, 'consultarXFiltro'])->middleware('auth')->name('filtro');

Route::resource('/libros', BookController::class)->middleware('auth')->names([
    'index' => 'libro.index', // Nombre para la ruta index
    'create' => 'libro.create', // Nombre para la ruta create
    'store' => 'libro.store', // Nombre para la ruta store
    'show' => 'libro.show', // Nombre para la ruta show
    'edit' => 'libro.edit', // Nombre para la ruta edit
    'update' => 'libro.update', // Nombre para la ruta update
    'destroy' => 'libro.destroy', // Nombre para la ruta destroy
]);

Route::resource('/administradores', AdministratorController::class)->middleware('auth')->names([
    'index' => 'administrador.index', // Nombre para la ruta index
    'create' => 'administrador.create', // Nombre para la ruta create
    'store' => 'administrador.store', // Nombre para la ruta store
    'show' => 'administrador.show', // Nombre para la ruta show
    'edit' => 'administrador.edit', // Nombre para la ruta edit
    'update' => 'administrador.update', // Nombre para la ruta update
    'destroy' => 'administrador.destroy', // Nombre para la ruta destroy
]);

Route::resource('/alumnos', StudentController::class)->middleware('auth')->names([
    'index' => 'alumno.index', // Nombre para la ruta index
    'create' => 'alumno.create', // Nombre para la ruta create
    'store' => 'alumno.store', // Nombre para la ruta store
    'show' => 'alumno.show', // Nombre para la ruta show
    'edit' => 'alumno.edit', // Nombre para la ruta edit
    'update' => 'alumno.update', // Nombre para la ruta update
    'destroy' => 'alumno.destroy', // Nombre para la ruta destroy
]);

Route::resource('/universidades', UniversityController::class)->names([
    'index' => 'universidad.index', // Nombre para la ruta index
    'create' => 'universidad.create', // Nombre para la ruta create
    'store' => 'universidad.store', // Nombre para la ruta store
    'show' => 'universidad.show', // Nombre para la ruta show
    'edit' => 'universidad.edit', // Nombre para la ruta edit
    'update' => 'universidad.update', // Nombre para la ruta update
    'destroy' => 'universidad.destroy', // Nombre para la ruta destroy
]);