<?php

use App\Http\Controllers\AdministratorController;
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

Route::view('/', 'welcome')->name('welcome');

Route::resource("/administradores", AdministratorController::class);
Route::view('/login', "login")->name('login');          //Ruta a la pagina de login
Route::view('/registro', "register")->name('registro'); //Ruta a la pagina de registro
Route::view('/registroadmin', "registeradmin")->name('registroadm'); //Ruta a la pagina de registro
//Route::view('/principal', "principal")->middleware('auth')->name('principal');     //Ruta a la pagina principal
Route::view('/detalles', "detalles_pelicula")->middleware('auth')->name('detalles-pelicula');     //Ruta a la pagina de detalles
Route::get('/principal', [MoviesController::class, 'index'])->middleware('auth')->name('principal');
Route::get('/principal/{movie}',[MoviesController::class, 'show'])->middleware('auth')->name('principal.show');
Route::view('/perfil', "perfil")->name('perfil')->middleware('auth');  //Ruta a la pagina de perfil
                                                                            //El metodo middleware sirve para proteger
                                                                            //la página, ya que para ingresar a ella
                                                                            //valida si esta una sesión activa, sino hay
                                                                            //una activa lo redirecciona al login

Route::post('/validar-registro', [ AdministratorController::class, 'register'])->name('validar-registro'); //Ruta para validar los datos ingresados
Route::post('/inicia-sesion', [ AdministratorController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');      //Ruta cuando uno presiona el cerrar sesion
Route::post('/contacto',[MessagesController::class, 'store']); //Ruta de la funcion de contacto.
Route::POST('/perfil/cambiarImagen', [ PerfilController::class, 'store' ])->name('cambiar-imagen');  //Ruta cuando se presiona el cambiar imagen
Route::POST('/perfil/cambiarDatos', [ PerfilController::class, 'update' ])->name('modificar-datos');    //Ruta cuando se envia el formulario de modificar perfil
Route::POST('/perfil/cambiarContrasena', [ PerfilController::class, 'cambiarContrasena' ])->name('cambiar-contrasena'); //Ruta cuando se envia el formulario de 
                                                                                                                        //cambio de contraseña