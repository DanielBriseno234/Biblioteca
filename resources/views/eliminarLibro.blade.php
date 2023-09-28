@extends('plantillas/plantillaGral')

@section('contenido')
<br>
    <div class="container bg-body-secondary rounded shadow">
        <h1 style="text-align: center">Eliminar libro</h1>
        <br>
        <div>
            <input class="form-control" type="text" placeholder="Nombre de libro a eliminar" aria-label="Titulo">
        </div>
        <br>
        <button type="button" class="btn btn-danger btn-lg">Eliminar libro</button>
        <hr>
        <a href="{{ route('adminregistrarlibro') }}">Agregar Libro</a>
    </div><br>
@endsection