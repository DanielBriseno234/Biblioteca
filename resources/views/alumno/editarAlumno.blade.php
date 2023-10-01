@extends('plantillas/plantillaGral')

@section('contenido')

    <div class="container mt-3">
        <form action="{{route('alumno.update', $alumno['id'])}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label for="enrollment" class="form-label">Matrícula</label>
                <input type="text" class="form-control" id="enrollment" name="enrollment" aria-describedby="emailHelp" value="{{$alumno['enrollment']}}">
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$alumno['name']}}">
            </div>
            <div class="mb-2">
                <label for="paternalSurname" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="paternalSurname" name="paternalSurname" value="{{$alumno['paternalSurname']}}">
            </div>
            <div class="mb-2">
                <label for="maternalSurname" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="maternalSurname" name="maternalSurname" value="{{$alumno['maternalSurname']}}">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$alumno['user']['email']}}">
            </div>
            {{-- <div class="mb-2">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" value="{{$alumno['user']['password']}}">
            </div> --}}
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

@endsection