<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfilController; //Extension del controlador que se utiliza
use App\Http\Controllers\MessagesController;
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

Route::resource("/administradores", AdministratorController::class);

Route::get('/login', [LoginController::class, "index"])->name('login');          //Ruta a la pagina de login
Route::get('/registroadmin', [LoginController::class, "indexRegistro"])->name('registroadm'); //Ruta a la pagina de registro
Route::post('/validar-registro', [ LoginController::class, 'register'])->name('validar-registro'); //Ruta para validar los datos ingresados
Route::post('/inicia-sesion', [ LoginController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('principal');

Route::view('/registro', "register")->name('registro'); //Ruta a la pagina de registro