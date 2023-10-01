<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiUniversitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $admin = University::all();
            return ApiResponse::success("Universidades consultadas con exito", 200, $admin);
            // throw new Exception("Error");
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar las universidades: " . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => ['required', 'string'],
                'protocol' => ['required', 'string'],
                'ip' => ['required', 'string'],
                'prefix' => ['required', 'string'],
                'endpoint' => ['required', 'string'],
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'protocol.required' => 'El protocolo es obligatoria.',
                'ip.required' => 'La ip es obligatoria.',
                'prefix.required' => 'El prefijo es obligatoria.',
                'endpoint.required' => 'El endpoint es obligatoria.',
            ]);
            
            $universidad = new University();
            $universidad->name = $request->name;
            $universidad->protocol = $request->protocol;
            $universidad->ip = $request->ip;
            $universidad->port = $request->port;
            $universidad->prefix = $request->prefix;
            $universidad->endpoint = $request->endpoint;
            $universidad->save();

            return ApiResponse::success("Universidad registrada correctamente", 200, $universidad);
        }catch(ValidationException $e){
            return ApiResponse::error("Error de validación: ".$e->getMessage(), 422);
        }catch(Exception $e){
            return ApiResponse::error("Error al registrar la universidad: ". $e->getMessage(), 500);
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $universidad = University::findOrFail($id);
            return ApiResponse::success("Universidad obtenida ezitosamente", 200, $universidad);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error("Universidad no encontrada", 404);
        }catch(Exception $e){
            return ApiResponse::error("Error al consultar la universidad: ". $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $universidad = University::findOrFail($id);
            
            $request->validate([
                'name' => ['required', 'string'],
                'protocol' => ['required', 'string'],
                'ip' => ['required', 'string'],
                'prefix' => ['required', 'string'],
                'endponit' => ['required', 'string'],
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'protocol.required' => 'El protocolo es obligatoria.',
                'ip.required' => 'La ip es obligatoria.',
                'prefix.required' => 'El prefijo es obligatoria.',
                'endpoint.required' => 'El endpoint es obligatoria.',
            ]);

            $universidad->name = $request->name;
            $universidad->protocol = $request->protocol;
            $universidad->ip = $request->ip;
            $universidad->port = $request->port;
            $universidad->prefix = $request->prefix;
            $universidad->endpoint = $request->endpoint;
            $universidad->save();

            return ApiResponse::success("Universidad modificada exitosamente", 200, $universidad);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error("Universidad no encontrada", 404);
        }catch(Exception $e){
            return ApiResponse::error("Error al actualizar la universidad: ". $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $universidad = University::findOrFail($id);
            $universidad->delete();
            return ApiResponse::success("Universidad eliminada exitosamente", 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Universidad no encontrada", 404);
        }
    }
}
