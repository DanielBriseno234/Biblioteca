@extends('plantillas/plantillaGral')

@section('contenido')
    <div class="container mt-3">
        <form action="{{ route('universidad.store') }}" method="post">
            @csrf
            <div class="mb-2">
                <label for="name" class="form-label">Nombre Institución</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="protocol" class="form-label">Protocolo</label>
                <select class="form-select" id="protocol" name="protocol" aria-label="Default select example">
                    <option value="sinPuerto" selected>Sin puerto</option>
                    <option value="Http">Http</option>
                    <option value="Https">Https</option>
                </select>
                {{-- <input type="text" class="form-control" id="protocol" name="protocol" aria-describedby="emailHelp"> --}}
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="ip" class="form-label">IP</label>
                <input type="text" class="form-control" id="ip" name="ip" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="port" class="form-label">Puerto</label>
                <input type="text" class="form-control" id="port" name="port" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="prefix" class="form-label">Prefijo</label>
                <input type="text" class="form-control" id="prefix" name="prefix" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="endpoint" class="form-label">Endpoint</label>
                <input type="text" class="form-control" id="endpoint" name="endpoint" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
@endsection
