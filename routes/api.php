<?php

use App\Http\Controllers\ApisControllers\ApiAdministratorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisControllers\ApiBooksController;
use App\Http\Controllers\ApisControllers\ApiStudentsController;
use App\Http\Controllers\ApisControllers\ApiUniversitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource("libros", ApiBooksController::class);
Route::resource("administradores", ApiAdministratorsController::class);
Route::resource("alumnos", ApiStudentsController::class);
Route::resource("universidades", ApiUniversitiesController::class);
