<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function obtenerUrlApiPropia()
    {
        $sel =  University::findOrFail(Auth::user()->university_id);

        $url = $sel->protocol . "://" . $sel->ip . ($sel->port != "" ? (":" . $sel->port) : "") . "/" . $sel->prefix;
        
        return $url;
    }

    public function obtenerUrlApiDemas($id){
        $sel =  University::findOrFail($id);
        $url = $sel->protocol . "://" . $sel->ip . ($sel->port != "" ? (":" . $sel->port) : "") . "/" . $sel->prefix . "/" . $sel->endpoint;
        return $url;
    }

    public function index()
    {
        $url = env("URL_API");
        if (Auth::check()) {
            if (Auth::user()->typeUser == "Admin") {
                $response = Http::get($url . "/libros");
                $data = $response->json();

                return view("principal", compact("data"));
            } else {
                $urlPropia = env("URL_API");
                $responseUniversities = Http::get($url . "/universidades");
                $dataUniversidades = $responseUniversities->json();
                return view("principal", compact("dataUniversidades"));
            }
        } else {
            return view("login");
        }
    }

    public function consultarXFiltro(String $id)
    {
        $urlLibros = $this->obtenerUrlApiDemas($id);
        
        $response = Http::acceptJson()->get($urlLibros);
        $data = $response->json();

        $url = env("URL_API");
        $response2 = Http::get($url . "/universidades");
        $dataUniversidades = $response2->json();

        $filtroId = $id;

        return view("principal", compact("dataUniversidades", "data", "filtroId"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
