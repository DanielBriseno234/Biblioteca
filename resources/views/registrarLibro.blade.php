@extends('plantillas/plantillaGral')

@section('contenido')
<br>
    <div class="container bg-body-secondary rounded shadow">
        <form action="{{route('libros.store')}}" method="post" url="upload" files="true" enctype="multipart/form-data">
            @csrf
            <h1 style="text-align: center">Registra un nuevo libro</h1>
            <div>
                <label for="formFileLg" class="form-label">Archivo de libro en pdf</label>
                <input class="form-control form-control-lg" id="formFileLg" name="file" type="file">
            </div>
            <div>
                <label for="formFileLg" class="form-label">Portada de libro</label>
                <input class="form-control form-control-lg" id="formFileLg" name="bookCover" type="file">
            </div>
            <br>
            <div>
                <input class="form-control" type="text" placeholder="Lenguaje" name="language" aria-label="Titulo">
            </div>
            <br>
            <div>
                <input class="form-control" type="text" placeholder="Titulo" name="title" aria-label="Titulo">
            </div>
            <br>
            <div>
                <input class="form-control" type="text" placeholder="Genero" name="genre" aria-label="Genero">
            </div><br>
            <div>
                <input class="form-control" type="text" placeholder="Editorial" name="editorial" aria-label="Editorial">
            </div><br>
            <br>
            <button type="submit" class="btn btn-success btn-lg">Subir libro</button>
            <hr>
        </form>
        {{-- <a href="{{ route('libros.destroy', ["id" => 1]) }}">Eliminar libro</a> --}}
    </div><br>
@endsection