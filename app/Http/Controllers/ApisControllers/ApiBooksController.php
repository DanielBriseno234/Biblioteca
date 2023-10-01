<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ApiBooksController extends Controller
{
    public function index()
    {
        try {
            $libros = new Book;
            $data = $libros::all();
            // throw new Exception("Error");
            return ApiResponse::success("Libros consultados con exito", 200, $data);
        } catch (Exception $e) {
            return ApiResponse::error("Error al consultar los libros: " . $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'language' => ['required', 'string'],
                'title' => ['required', 'string'],
                'genre' => ['required', 'string'],
                'editorial' => ['required', 'string'],
                'file' => ['required', 'string'],
                'bookCover' => ['required', 'string']
            ],
            // [
            //     'languaje.required' => 'El nombre es obligatorio.',
            //     'title.required' => 'La Descripción es obligatorio.',
            //     'title.required' => 'La Descripción es obligatorio.',
            // ]
        );

        try {
            $libro = new Book;
            $libro->language = $request->language;
            $libro->title = $request->title;
            $libro->genre = $request->genre;
            $libro->editorial = $request->editorial;
            $libro->status = 0;
            $libro->file = $request->file;
            $libro->bookCover = $request->bookCover;
            $libro->save();

            return ApiResponse::success("Libro registrado exitosamente", 200, $libro);
            // throw new Exception("Error");
        } catch (ValidationException $e) {
            return ApiResponse::error("Error de validación: " . $e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error("Error al registrar la marca: " . $e->getMessage(), 500);
        }
    }

    public function show(string $id)
    {
        try{
            $libro = Book::findOrFail($id);
            return ApiResponse::success("Libro obtenido exitosamente", 200, $libro);
            // throw new Exception("Error");
        }catch(ModelNotFoundException $e){
            return ApiResponse::error("Libro no encontrado", 404);
        }catch(Exception $e){
            return ApiResponse::error("Error al consultar el libro: ". $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'language' => ['required', 'string'],
                'title' => ['required', 'string'],
                'genre' => ['required', 'string'],
                'editorial' => ['required', 'string'],
                'file' => ['nullable','string'],
                'bookCover' => ['nullable','string']
            ],
            // [
            //     'languaje.required' => 'El nombre es obligatorio.',
            //     'title.required' => 'La Descripción es obligatorio.',
            //     'title.required' => 'La Descripción es obligatorio.',
            // ]
        );

        try{
            $datosLibro = [
                'language' => $request->language,
                'title' => $request->title,
                'genre' => $request->genre,
                'editorial' => $request->editorial,
                'status' =>  0
            ];
            
            if ($request->file) {
                $datosLibro['file'] = $request->file;
            }
            if ($request->bookCover) {
                $datosLibro['bookCover'] = $request->bookCover;
            }

            $libro = Book::findOrFail($id);

            $libro->update($datosLibro);
            return ApiResponse::success("Libro modificado exitosamente", 200, $libro);
            // throw new Exception("Error");
        }catch(ModelNotFoundException $e){
            return ApiResponse::error("Libro no encontrado", 404);
        }catch(Exception $e){
            return ApiResponse::error("Error al actualizar el libro: ". $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $libro = Book::findOrFail($id);
            $libro->delete();
            return ApiResponse::success("Libro eliminado exitosamente", 200);
            // throw new Exception("Error");
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Libro no encontrado", 404);
        }catch(Exception $e){
            return ApiResponse::error("Error al eliminar el libro: ". $e->getMessage(), 500);
        }
    }
}
