<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        dd($data);
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
        $url = env("URL_API");

        $response = Http::post($url . "/administradores", [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrator $administrators)
    {
        $url = env("URL_API");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrators)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrator $administrators)
    {
        $url = env("URL_API");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrators)
    {
        $url = env("URL_API");
    }
}
