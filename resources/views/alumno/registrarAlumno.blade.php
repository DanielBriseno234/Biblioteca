@extends('plantillas/plantillaGral')

@section('contenido')

    <div class="container mt-3">
        <form action="{{route('alumno.store')}}" method="post">
            @csrf
            <div class="mb-2">
                <label for="enrollment" class="form-label">Matrícula</label>
                <input type="text" class="form-control" id="enrollment" name="enrollment" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="paternalSurname" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="paternalSurname" name="paternalSurname" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="maternalSurname" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="maternalSurname" name="maternalSurname" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>

@endsection