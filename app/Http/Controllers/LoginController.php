<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
USE App\Models\User;
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function register(Request $request){
        // Validación de datos
        // request()->validate([
        //     'name' => 'required',
        //     'paternalSurname' => 'required',
        //     'maternalSurname' => 'required',
        // ],
        // [
        //     // Mensajes de validación
        //     'name.required' => 'Introduzca su Nombre.',
        //     'paternalSurname.required' => 'Introduzca su apellido paterno.',
        //     'maternalSurname.required' => 'Introduzca su apellido materno.',
        // ]);

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
        
        return redirect(route('welcome'));  // Redireccionar a la página principal
    }

    public function login(Request $request){
        //De igual forma debe de haber una validación de datos
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],
        [
            //Estos son los mensajes que se mostrarán en caso de no cumplir con las reglas
            'email.required' =>'Introduzca un correo.',
            'email.email' => 'Introduzca un correo valido.',
            'password.required' => 'Introduzca su contraseña.',
            'password.min' => 'Debe de contener minimo 8 caracteres.',
        ]);


        //Estas son los datos de inicio de sesion, por ende es el email y la contaseña
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
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
            return redirect()->intended(route('principal'));  //Si quiere ingresar a una diferente de la principal lo puede hacer
                                                            //Pero tiene que iniciar sesión, si no hace esto lo manda por default a la principal
        }else{ //Si el usuario no tiene las credenciales y no marca la casilla de mantener la sesion, lo redirecciona al login
            throw ValidationException::withMessages([
                'password' => "El correo o la contraseña son incorrectas"
            ]);
        }

    }

    public function logout(Request $request){
        Auth::logout(); //Con este metodo simplemente cierra la sesion iniciada

        $request->session()->invalidate();  //Destruye la sesión
        $request->session()->regenerate();  //Y la elimina

        return redirect(route('login'));    //Redirección a la pagina del login
    }
}
