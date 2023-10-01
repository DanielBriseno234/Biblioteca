<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacio

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

        return view("administrador.administradores", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("administrador.registrarAdministrador");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env("URL_API");
        $response = Http::post($url . "/administradores", [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
            "typeUser" => "Admin",
            'university_id' => 1
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
            return view("administrador.administradores", compact("administrador"));
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
            return view("administrador.editarAdministrador", compact("admin"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $url = env("URL_API");
        $response = Http::put($url . '/administradores/' . $id, [
            'email' => $request->email,
            // 'password' => $request->password,
            'name' => $request->name,
            'paternalSurname' => $request->paternalSurname,
            'maternalSurname' => $request->maternalSurname,
        ]);

        $data = $response->json();

        // dd($data);

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
}
