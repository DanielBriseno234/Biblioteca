@extends('plantillas/plantillaGral')

@section('estilos')
    <link rel="stylesheet" href="js/sweetalert/sweetalert2.css">
@endsection

@section('contenido')
    <div class="container">
        <h1 class="text-center mt-3">Gestión de Libros</h1>
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
                        <th scope="col">Título</th>
                        <th scope="col">Lenguaje</th>
                        <th scope="col">Género</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($data['data']))
                        <tr>
                            <td colspan="5" class="text-center">No hay libros registrados</td>
                        </tr>
                    @endif
                    @foreach ($data['data'] as $libro)
                        <tr>
                            <td>{{ $libro['title'] }}</td>
                            <td>{{ $libro['language'] }}</td>
                            <td>{{ $libro['genre'] }}</td>
                            <td>{{ $libro['editorial'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('libro.edit', $libro['id']) }}" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger"
                                    onclick="eliminar(event, {{ $libro['id'] }})">Eliminar</button>

                                <form action="{{ route('libro.destroy', $libro['id']) }}" method="post"
                                    id="eliminar-{{ $libro['id'] }}" style="display: none;">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('libro.create') }}" class="btn btn-success">Registrar Libro</a>
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
