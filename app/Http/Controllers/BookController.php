<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env("URL_API");

        $response = Http::get($url . "/libros");
        $data = $response->json();

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

        $response = Http::post($url . "/libros", [
            'languaje' => $request->language,
            'title' => $request->language,
            'genre' => $request->language,
            'editorial' => $request->language,
            'file' => $request->language,
        ]);

        $data = $response->json();

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $url = env("URL_API");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $url = env("URL_API");
    }
}
