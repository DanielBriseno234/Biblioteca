@extends('plantillas/plantillaGral')

@section('contenido')
<br>
<div class="container bg-body-secondary">
    <h1 style="text-align: center">Encuentra un libro externo</h1>
    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary" type="button" id="button-addon1">Buscar</button>
        <input type="text" class="form-control" placeholder="Libros disponibles" aria-label="..." aria-describedby="button-addon1">
    </div>

    <div class="card" style="text-align: center">
        <div class="card-body">
            <img src="" alt="libro no encontrado" class="card-img-top">
            <h5 class="card-title">
                TITULO DE LIBRO
            </h5>
            <p class="card-text">
                pequeña informacion del libro
            </p>
            <a href="#" class="btn btn-success">Desacargar libro</a>
        </div>
    </div><br>
</div>
@endsection