<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("registrarLibro");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $url = env("URL_API");

        $response = Http::post($url .'/libros', [
            'language' => request('language'),
            'title' => request('title'),
            'genre' => request('genre'),
            'editorial' => request('editorial'),
            'status' => 0,
            'file' => 'prueba',
            'bookCover' => 'prueba'
        ]);

        $data = $response->json();

        if ($data["error"]) {
            return redirect('/')->with('error', $data["message"]);
        } else {
            return redirect('/')->with('success', $data["message"]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
