@extends('plantillas/plantillaGral')

@section('estilos')
    <link rel="stylesheet" href="js/sweetalert/sweetalert2.css">
@endsection

@section('contenido')
    <div class="container">
        <h1 class="text-center mt-3">Gestión de Alumnos</h1>
        @if ($data['error'])
            <div class="card text-center w-100">
                <div class="card-header">
                    Ocurrió un error
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $data['message'] }}</h5>
                    <p class="card-text">Vuelve a intentarlo, si el problema persiste contacte a soporte.</p>
                </div>
                <div class="card-footer text-muted">
                    <p>Estatus: {{ $data['status'] }}</p>
                </div>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ap. Paterno</th>
                        <th scope="col">Ap. Materno</th>
                        <th scope="col">Email</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($data['data']))
                        <tr>
                            <td colspan="6" class="text-center">No hay alumnos registrados</td>
                        </tr>
                    @endif
                    @foreach ($data['data'] as $alumno)
                        <tr>
                            <td>{{ $alumno['enrollment'] }}</td>
                            <td>{{ $alumno['name'] }}</td>
                            <td>{{ $alumno['paternalSurname'] }}</td>
                            <td>{{ $alumno['maternalSurname'] }}</td>
                            <td>{{ $alumno['user']['email'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('alumno.edit', $alumno['id']) }}" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger"
                                    onclick="eliminar(event, {{ $alumno['id'] }})">Eliminar</button>

                                <form action="{{ route('alumno.destroy', $alumno['id']) }}" method="post"
                                    id="eliminar-{{ $alumno['id'] }}" style="display: none;">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('alumno.create') }}" class="btn btn-success">Registrar Alumno</a>
        @endif
    </div>
@endsection


@section('javascript')
    <script src="js/sweetalert/sweetalert2.js" charset="UTF-8"></script>
    <script src="js/jquery/jquery-3.7.0.js"></script>
    <script src="js/utilidades.js"></script>

    @if (session('success'))
        <script>
            swal({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                type: 'success',
                showConfirmButton: true,
                timer: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            swal({
                title: '¡Error!',
                text: '{{ session('error') }}',
                type: 'error',
                showConfirmButton: true,
            });
        </script>
    @endif
@endsection
