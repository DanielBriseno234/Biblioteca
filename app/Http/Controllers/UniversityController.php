<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env("URL_API");
        $response = Http::get($url . "/universidades");

        $data = $response->json();
        return view("universidad.universidad", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("universidad.registrarUniversidad");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env("URL_API");
        $response = Http::post($url . "/universidades", [
            'name' => $request->name,
            'protocol' => $request->protocol,
            'ip' => $request->ip,
            'port' => $request->port == 'sinPuerto' ? '' : $request->port,
            'prefix' => $request->prefix,
            'endpoint' => $request->endpoint
        ]);

        $data = $response->json();

        if ($data["error"]) {
            return redirect('/universidades')->with('error', $data["message"]);
        } else {
            return redirect('/universidades')->with('success', $data["message"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $url = env("URL_API");
        $response = Http::get($url . '/universidades/' . $id);

        $data = $response->json();
        $universidad = $data["data"];

        if ($data["error"]) {
            return redirect('/universidades')->with('error', $data["message"]);
        } else {
            return view("universidad.editarUniversidad", compact("universidad"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $url = env("URL_API");
        $response = Http::put($url . '/universidades/' . $id, [
            'name' => $request->name,
            'protocol' => $request->protocol,
            'ip' => $request->ip,
            'port' => $request->port == 'sinPuerto' ? '' : $request->port,
            'prefix' => $request->prefix,
            'endpoint' => $request->endpoint
        ]);

        $data = $response->json();

        // dd($data);

        if ($data["error"]) {
            return redirect('/universidades')->with('error', $data["message"]);
        } else {
            return redirect('/universidades')->with('success', $data["message"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $url = env("URL_API");
        $response = Http::delete($url . '/universidades/' . $id);
        $data = $response->json();
        if ($data["error"]) {
            return redirect('/universidades')->with('error', $data["message"]);
        } else {
            return redirect('/universidades')->with('success', $data["message"]);
        }
    }
}
