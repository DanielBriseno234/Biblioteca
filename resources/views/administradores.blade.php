@extends('plantillas/plantillaGral')

@section('contenido')
    <div class="container">
        <h1 class="text-center mt-3">Gestión de administradores</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Ap. Paterno</th>
                <th scope="col">Ap. Materno</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data["data"] as $admin)
                <tr>
                    <td>{{ $admin["name"] }}</td>
                    <td>{{ $admin["paternalSurname"] }}</td>
                    <td>{{ $admin["maternalSurname"] }}</td>
                    <td>{{ $admin["user"]["email"] }}</td>
                    <td class="text-center">
                        <a href="{{ route('administrador.edit', $admin['id']) }}" class="btn btn-primary">Editar</a>
                        <form action="{{route('administrador.destroy', $admin['id'])}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
        <a href="{{ route('administrador.create') }}" class="btn btn-success">Registrar Administrador</a>
    </div>
@endsection