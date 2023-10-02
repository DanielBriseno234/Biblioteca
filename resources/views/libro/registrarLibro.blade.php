@extends('plantillas/plantillaGral')

@section('contenido')
    <br>
    <div class="container bg-body-secondary rounded shadow">
        <form action="{{ route('libro.store') }}" method="post" url="upload" files="true" enctype="multipart/form-data">
            @csrf
            <h1 style="text-align: center">Registra un nuevo libro</h1>
            <div>
                <label for="inputPdf" class="form-label">Archivo de libro en pdf</label>
                <input class="form-control form-control-lg" id="inputPdf" type="file"
                    onchange="convertirPDFaBS64();">
            </div>
            <div>
                <label for="inputImage" class="form-label">Portada de libro</label>
                <input class="form-control form-control-lg" id="inputImagen" onchange="convertirImagenaBase64();"
                     type="file">
            </div>
            <div class="d-none">
                <input type="text" name="file" id="file">
                <input type="text" name="bookCover" id="bookCover">
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

@section('javascript')
    <script src="js/sweetalert/sweetalert2.js" charset="UTF-8"></script>
    <script src="js/jquery/jquery-3.7.0.js"></script>
    <script src="../js/utilidades.js"></script>
@endsection
