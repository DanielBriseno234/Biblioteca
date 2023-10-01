@extends('plantillas/plantillaGral')

@section('contenido')
<br>
<div class="container text-center">

    <div class="row">

        {{-- <div class="input-group mb-3">
            <button class="btn btn-outline-secondary" type="button" id="button-addon1">Buscar</button>
            <input type="text" class="form-control" placeholder="Libros locales" aria-label="..." aria-describedby="button-addon1">
        </div> --}}

        @foreach ($data["data"] as $libro)
            <div class="col">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="" alt="libro no encontrado" class="card-img-top">
                            <h5 class="card-title">
                                {{ $libro["title"] }}
                            </h5>
                            <p class="card-text">
                                Género: {{ $libro["genre"] }}
                            </p>
                            <p class="card-text">
                                Editorial: {{$libro["editorial"]}}
                            </p>
                            <a href="#" class="btn btn-success">Descargar libro</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



</div>
@endsection
