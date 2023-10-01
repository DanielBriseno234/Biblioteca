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

        return view("alumno.alumnos", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("alumno.registrarAlumno");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // request()->validate([
        //     'enrollment' => 'required|min:8|max:20',
        //     'name' => 'required',
        //     'paternalSurname' => 'required',
        //     'maternalSurname' => 'required',
        //     'email' => 'required',
        //     'password' => 'required'
        // ],
        // [
        //     // Mensajes de validación
        //     'enrollment.required' => 'Introduzca su contraseña.',
        //     'enrollment.max' => 'Debe contener menos de 20 caracteres.',
        //     'enrollment.min' => 'Debe contener mínimo 8 caracteres.',
        //     'name.required' => 'Introduzca su Nombre.',
        //     'paternalSurname.required' => 'Introduzca su apellido paterno.',
        //     'maternalSurname.required' => 'Introduzca su apellido materno.',
        //     'email.required' => 'Introduzca un email',
        //     'password.required' => "Introduzca una contraseña"
        // ]);

        $url = env("URL_API");
        $response = Http::post($url . "/alumnos", [
            'enrollment' => $request->enrollment,
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
            "typeUser" => "student",
            'university_id' => 1
        ]);

        $data = $response->json();

        if ($data["error"]) {
            return redirect('/alumnos')->with('error', $data["message"]);
        } else {
            return redirect('/alumnos')->with('success', $data["message"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $students)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $url = env("URL_API");
        $response = Http::get($url . '/alumnos/' . $id);

        $data = $response->json();
        $alumno = $data["data"];

        if ($data["error"]) {
            return redirect('/alumnos')->with('error', $data["message"]);
        } else {
            return view("alumno.editarAlumno", compact("alumno"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $url = env("URL_API");
        $response = Http::put($url . '/alumnos/' . $id, [
            'enrollment' => $request->enrollment,
            'email' => $request->email,
            
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
        ]);

        $data = $response->json();

        // dd($data);

        if ($data["error"]) {
            return redirect('/alumnos')->with('error', $data["message"]);
        } else {
            return redirect('/alumnos')->with('success', $data["message"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $url = env("URL_API");
        $response = Http::delete($url . '/alumnos/' . $id);
        $data = $response->json();
        if ($data["error"]) {
            return redirect('/alumnos')->with('error', $data["message"]);
        } else {
            return redirect('/alumnos')->with('success', $data["message"]);
        }
    }



}
