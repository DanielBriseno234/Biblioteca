<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

//Extensiones de archivos que tenemos que utilizar para iniciar sesión
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env("URL_API");
        $response = Http::get($url . "/alumnos");

        $data = $response->json();

        return view("", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'enrollment' => 'required|min:8|max:20',
            'name' => 'required',
            'paternalSurname' => 'required',
            'maternalSurname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ],
        [
            // Mensajes de validación
            'enrollment.required' => 'Introduzca su contraseña.',
            'enrollment.max' => 'Debe contener menos de 20 caracteres.',
            'enrollment.min' => 'Debe contener mínimo 8 caracteres.',
            'name.required' => 'Introduzca su Nombre.',
            'paternalSurname.required' => 'Introduzca su apellido paterno.',
            'maternalSurname.required' => 'Introduzca su apellido materno.',
            'email.required' => 'Introduzca un email',
            'password.required' => "Introduzca una contraseña"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $students)
    {
        //
    }

    //Función para registrar un nuevo usuario
    public function register(Request $request){
        // Validación de datos
        request()->validate([
            'enrollment' => 'required|min:8|max:20',
            'name' => 'required',
            'paternalSurname' => 'required',
            'maternalSurname' => 'required',
        ],
        [
            // Mensajes de validación
            'enrollment.required' => 'Introduzca su contraseña.',
            'enrollment.max' => 'Debe contener menos de 20 caracteres.',
            'enrollment.min' => 'Debe contener mínimo 8 caracteres.',
            'name.required' => 'Introduzca su Nombre.',
            'paternalSurname.required' => 'Introduzca su apellido paterno.',
            'maternalSurname.required' => 'Introduzca su apellido materno.',
        ]);
    
        if (Auth::check()) {
            // Crear un nuevo estudiante
            $student = new Student();
            $student->enrollment = Hash::make($request->enrollment);
            $student->name = $request->name;
            $student->paternalSurname = $request->paternalSurname;
            $student->maternalSurname = $request->maternalSurname;
    
            // Asignar el ID del usuario actual
            $student->user_id = Auth::user()->id;
    
            $student->save(); // Guardar el estudiante
    
            return redirect(route('principal'));  // Redireccionar a la página principal
        } else {
            // Manejo de errores, por ejemplo, redirigir a la página de inicio de sesión
            return redirect(route('login'))->with('error', 'Debes iniciar sesión para registrar un estudiante.');
        }
    }

}
