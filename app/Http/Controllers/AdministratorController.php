<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacio
use Illuminate\Validation\ValidationException;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env("URL_API");

        $response = Http::get($url . "/administradores");
        $data = $response->json();

        return view("administradores", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("registrarAdmin");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env("URL_API");
        $response = Http::post($url . "/administradores", [
            'email' => $request->name,
            'password' => $request->password,
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
        ]);

        $data = $response->json();

        if ($data["error"]) {
            return redirect('/administradores')->with('error', $data["message"]);
        } else {
            return redirect('/administradores')->with('success', $data["message"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $url = env("URL_API");
        $response = Http::get($url . '/administradores/' . $id);
        $data = $response->json();
        $administrador = $data["data"];

        if ($data["error"]) {
            return redirect('/administradores')->with('error', $data["message"]);
        } else {
            return view("administradores", compact("administrador"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = env("URL_API");
        $response = Http::get($url . '/administradores/' . $id);

        $data = $response->json();
        $admin = $data["data"];

        if ($data["error"]) {
            return redirect('/administradores')->with('error', $data["message"]);
        } else {
            return view("editarAdministrador", compact("admin"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $url = env("URL_API");
        $response = Http::put($url . '/administradores/' . $id, [
            'email' => $request->name,
            'password' => $request->password,
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
        ]);

        $data = $response->json();

        dd($data);

        if ($data["error"]) {
            return redirect('/administradores')->with('error', $data["message"]);
        } else {
            return redirect('/administradores')->with('success', $data["message"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $url = env("URL_API");
        $response = Http::delete($url . '/administradores/' . $id);
        $data = $response->json();
        if ($data["error"]) {
            return redirect('/administradores')->with('error', $data["message"]);
        } else {
            return redirect('/administradores')->with('success', $data["message"]);
        }
    }

    public function register(Request $request){
        // Validación de datos
        request()->validate([
            'name' => 'required',
            'paternalSurname' => 'required',
            'maternalSurname' => 'required',
        ],
        [
            // Mensajes de validación
            'name.required' => 'Introduzca su Nombre.',
            'paternalSurname.required' => 'Introduzca su apellido paterno.',
            'maternalSurname.required' => 'Introduzca su apellido materno.',
        ]);


            // Crear un nuevo estudiante
            $admin = new Administrator();
            $admin->name = $request->name;
            $admin->paternalSurname = $request->paternalSurname;
            $admin->maternalSurname = $request->maternalSurname;

            // Asignar el ID del usuario actual

            $admin->save(); // Guardar el estudiante

            return redirect(route('welcome'));  // Redireccionar a la página principal

    }

    public function login(Request $request){
        //De igual forma debe de haber una validación de datos
        request()->validate([
            'name' => 'required',
            'paternalSurname' => 'required',
        ],
        [
            //Estos son los mensajes que se mostrarán en caso de no cumplir con las reglas
            'name.required' =>'Introduzca un correo.',
            'name.name' => 'Introduzca un correo valido.',
            'paternalSurname.required' => 'Introduzca su contraseña.',
            'paternalSurname.min' => 'Debe de contener minimo 8 caracteres.',
        ]);


        //Estas son los datos de inicio de sesion, por ende es el name y la contaseña
        $credentials = [
            "name" => $request->name,
            "paternalSurname" => $request->paternalSurname,
            //"active" => true
        ];

        //Esta parte sirve en el momento en el que el usuario marca que quiere tener la sesion iniciada
        //si la marca se asigna como true, sino pues se mantiene false
        $remember = ($request->has('remember') ? true : false);

        //Esto sirve para que se haga un intento de inicio de sesión automatico
        //Si las credenciales estan y se marca la opcion de mantener la sesion
        //el sistema accede automaticamente
        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();      //aqui borra las sesiones anteriores, en caso de haber mantenido una perdida

            //Esto ayuda en dado caso que intente ingresar a cualquier página desde la url
            return redirect()->intended(route('welcome'));  //Si quiere ingresar a una diferente de la principal lo puede hacer
                                                            //Pero tiene que iniciar sesión, si no hace esto lo manda por default a la principal
        }else{ //Si el usuario no tiene las credenciales y no marca la casilla de mantener la sesion, lo redirecciona al login
            throw ValidationException::withMessages([
                'paternalSurname' => "El correo o la contraseña son incorrectas"
            ]);
        }

    }
}
