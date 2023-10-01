<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $alumnos = Student::with('user')->get();
            return ApiResponse::success("Alumos consultados con exito", 200, $alumnos);
            // throw new Exception("Error");
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar los alumnos: " . $e->getMessage(), 500);
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

            $datosAlumno = [
                'enrollment' => $request->enrollment,
                'name' => $request->name,
                'paternalSurname' => $request->paternalSurname,
                'maternalSurname' => $request->maternalSurname,
            ];

            // Crear una nueva instancia de Usuario
            $usuario = User::create($datosUsuario);

            // Crear una nueva instancia de Perfil y asociarla al usuario
            $alumno = new Student($datosAlumno);
            $usuario->administrator()->save($alumno);

            $usuario->save();
            $alumno->save();

            return ApiResponse::success("Alumno registrado con exito", 200, $usuario);
        } catch (ValidationException $e) {
            return ApiResponse::error("Error de validación: " . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error("Error al registrar el alumno: " . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $alumno = Student::with('user')->findOrFail($id);
            return ApiResponse::success("Alumno consultado exitosamente", 200, $alumno);
            // throw new Exception("Error");
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Alumno no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar el alumno: " . $e->getMessage(), 500);
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
                "password" => Hash::make($request->password)
            ];

            $datosAlumno = [
                'enrollment' => $request->enrollment,
                'name' => $request->name,
                'paternalSurname' => $request->paternalSurname,
                'maternalSurname' => $request->maternalSurname,
            ];

            $alumno = Student::findOrFail($id);
            $alumno->update($datosAlumno);
            $user = $alumno->user;
            $user->update($datosUsuario);

            return ApiResponse::success("Alumno modificado exitosamente", 200, $alumno);
            // throw new Exception("Error");
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Alumno no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al actualizar el alumno: " . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $alumno = Student::findOrFail($id);
    
            // Obtener el usuario asociado
            $user = $alumno->user;
    
            // Eliminar el administrador
            $alumno->delete();
    
            // Eliminar el usuario asociado
            $user->delete();
    
            return ApiResponse::success("Alumno y usuario eliminados exitosamente", 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Alumno no encontrado", 404);
        } catch (Exception $e) {
            return ApiResponse::error("Error al eliminar el Alumno: " . $e->getMessage(), 500);
        }
    }
}
