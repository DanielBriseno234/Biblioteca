<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\User;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ApiAdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $admin = Administrator::with('user')->get();
            // $admin = Administrator::find(1)->user;
            return ApiResponse::success("Administradores consultados con exito", 200, $admin);
            // throw new Exception("Error");
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar los administradores: " . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Obtener los datos del formulario
            $datosUsuario = [
                'email' => $request->email,
                "password" => $request->password
            ];

            $datosAdmin = [
                'name' => $request->name,
                'paternalSurname' => $request->paternalSurname,
                'maternalSurname' => $request->maternalSurname,
            ];

            // Crear una nueva instancia de Usuario
            $usuario = User::create($datosUsuario);

            // Crear una nueva instancia de Perfil y asociarla al usuario
            $admin = new Administrator($datosAdmin);
            $usuario->administrator()->save($admin);

            $usuario->save();
            $admin->save();

            return ApiResponse::success("Administrador registrado con exito", 200, $usuario);
        } catch (ValidationException $e) {
            return ApiResponse::error("Error de validación: " . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error("Error al registrar el administrador: " . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $admin = Administrator::with('user')->findOrFail($id);
            return ApiResponse::success("Administrador consultado exitosamente", 200, $admin);
            // throw new Exception("Error");
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Administrador no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar el administrador: " . $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate(
        //     [
        //         'language' => ['required', 'string'],
        //         'title' => ['required', 'string'],
        //         'genre' => ['required', 'string'],
        //         'editorial' => ['required', 'string'],
        //         'file' => ['required', 'string'],
        //     ],
        //     // [
        //     //     'languaje.required' => 'El nombre es obligatorio.',
        //     //     'title.required' => 'La Descripción es obligatorio.',
        //     //     'title.required' => 'La Descripción es obligatorio.',
        //     // ]
        // );

        try {

            // Obtener los datos del formulario
            $datosUsuario = [
                'email' => $request->email,
                "password" => $request->password
            ];

            $datosAdmin = [
                'name' => $request->name,
                'paternalSurname' => $request->paternalSurname,
                'maternalSurname' => $request->maternalSurname,
            ];

            $admin = Administrator::findOrFail($id);
            $admin->update($datosAdmin);
            $user = $admin->user;
            $user->update($datosUsuario);

            return ApiResponse::success("Administrador modificado exitosamente", 200, $admin);
            // throw new Exception("Error");
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Administrador no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al actualizar el administrador: " . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $admin = Administrator::findOrFail($id);
    
            // Obtener el usuario asociado
            $user = $admin->user;
    
            // Eliminar el administrador
            $admin->delete();
    
            // Eliminar el usuario asociado
            $user->delete();
    
            return ApiResponse::success("Administrador y usuario eliminados exitosamente", 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Administrador no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al eliminar el administrador: " . $e->getMessage(), 500);
        }
    }
}
