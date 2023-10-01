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
        $url = env("URL_API");
        $response = Http::get($url . "/libros");
        $data = $response->json();

        return view("libro.libros", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("libro.registrarLibro");
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
            'file' => request('file'),
            'bookCover' => request('bookCover')
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $url = env("URL_API");
        $response = Http::get($url . '/libros/' . $id);

        $data = $response->json();
        $libro = $data["data"];

        if ($data["error"]) {
            return redirect('/libros')->with('error', $data["message"]);
        } else {
            return view("libro.editarLibro", compact("libro"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $url = env("URL_API");
        $response = Http::put($url . '/libros/' . $id, [
            'language' => request('language'),
            'title' => request('title'),
            'genre' => request('genre'),
            'editorial' => request('editorial'),
            'status' => 0,
            'file' => request('file'),
            'bookCover' => request('bookCover')
        ]);

        $data = $response->json();

        if ($data["error"]) {
            return redirect('/libros')->with('error', $data["message"]);
        } else {
            return redirect('/libros')->with('success', $data["message"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $url = env("URL_API");
        $response = Http::delete($url . '/libros/' . $id);
        $data = $response->json();
        if ($data["error"]) {
            return redirect('/libros')->with('error', $data["message"]);
        } else {
            return redirect('/libros')->with('success', $data["message"]);
        }
    }
}
