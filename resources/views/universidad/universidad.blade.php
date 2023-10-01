@extends('plantillas/plantillaGral')

@section('estilos')
    <link rel="stylesheet" href="js/sweetalert/sweetalert2.css">
@endsection

@section('contenido')
    <div class="container">
        <h1 class="text-center mt-3">Gestión de Universidades</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Protocolo</th>
                    <th scope="col">IP</th>
                    <th scope="col">Puerto</th>
                    <th scope="col">Prefijo</th>
                    <th scope="col">Endpoint</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $universidad)
                    <tr>
                        <td>{{ $universidad['name'] }}</td>
                        <td>{{ $universidad['protocol'] }}</td>
                        <td>{{ $universidad['ip'] }}</td>
                        <td>{{ $universidad['port'] }}</td>
                        <td>{{ $universidad['prefix'] }}</td>
                        <td>{{ $universidad['endpoint'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('universidad.edit', $universidad['id']) }}" class="btn btn-primary">Editar</a>
                            @if (Auth::user()->university_id != $universidad['id'])
                                <button type="button" class="btn btn-danger"
                                    onclick="eliminar(event, {{ $universidad['id'] }})">Eliminar</button>
                                <form action="{{ route('universidad.destroy', $universidad['id']) }}" method="post"
                                    id="eliminar-{{ $universidad['id'] }}" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('universidad.create') }}" class="btn btn-success">Registrar Universidad</a>
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
