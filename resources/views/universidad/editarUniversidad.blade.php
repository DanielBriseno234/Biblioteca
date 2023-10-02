@extends('plantillas/plantillaGral')

@section('contenido')
    <div class="container mt-3">
        <form action="{{ route('universidad.update', $universidad['id']) }}" method="post">
            @csrf
            @method("PUT")
            <div class="mb-2">
                <label for="name" class="form-label">Nombre Institución</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$universidad['name']}}">
            </div>
            <div class="mb-2">
                <label for="protocol" class="form-label">Protocolo</label>
                <select class="form-select" id="protocol" name="protocol" aria-label="Default select example">
                    <option value="http" @if($universidad['protocol'] == 'http') selected @endif>http</option>
                    <option value="https" @if($universidad['protocol'] == 'https') selected @endif>https</option>
                </select>
                {{-- <input type="text" class="form-control" id="protocol" name="protocol" aria-describedby="emailHelp"> --}}
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="ip" class="form-label">IP</label>
                <input type="text" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="{{$universidad['ip']}}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="port" class="form-label">Puerto</label>
                <input type="text" class="form-control" id="port" name="port" aria-describedby="emailHelp" value="{{$universidad['port']}}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="prefix" class="form-label">Prefijo</label>
                <input type="text" class="form-control" id="prefix" name="prefix" aria-describedby="emailHelp" value="{{$universidad['prefix']}}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <label for="endpoint" class="form-label">Endpoint</label>
                <input type="text" class="form-control" id="endpoint" name="endpoint" aria-describedby="emailHelp" value="{{$universidad['endpoint']}}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <button type="submit" class="btn btn-primary">Editar universidad</button>
        </form>
    </div>
@endsection
