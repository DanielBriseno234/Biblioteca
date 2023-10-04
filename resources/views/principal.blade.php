@extends('plantillas/plantillaGral')

@section('contenido')
    <div class="container mt-3">
        <h1 class="text-center">Libros</h1>
        @if (Auth::user()->typeUser == 'student')
            <form class="my-3 d-flex align-items-center justify-content-center"
                action="{{ route('filtro', isset($filtroId) ? $filtroId : 1) }}" method="post" id="filtroForm"
                data-original-action="{{ route('filtro', 'aquicolocar') }}">
                @csrf
                <label for="universidades" class="me-2">Filtro:</label>
                <select class="form-select" id="universidades" aria-label="Default select example" name="VarUniversidad">
                    <option disabled>Selecciona una universidad</option>
                    @foreach ($dataUniversidades['data'] as $universidad)
                        <option value="{{ $universidad['id'] }}"
                            {{ isset($filtroId) && $universidad['id'] == $filtroId ? 'selected' : '' }}>
                            {{ $universidad['name'] }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 btn btn-primary">Filtrar</button>
            </form>
        @endif
    </div>
    <div class="container">
        @if (isset($data['data']))
            @if (isset($data['error']) && $data['error'] === true)
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
                @if (empty($data['data']))
                    <h5>No hay libros registrados</h5>
                @else
                    <div class="row">
                        @foreach ($data['data'] as $libro)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card mb-3 w-100">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="{{ $libro['bookCover'] }}" class="img-fluid rounded-start"
                                                alt="...">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <div>
                                                    <h6 class="card-title">{{ $libro['title'] }}</h6>
                                                    <p class="card-text mb-0">Género: {{ $libro['genre'] }}</p>
                                                    <small class="card-text">Editorial: {{ $libro['editorial'] }}</small>
                                                </div>
                                                <div class="mt-3">
                                                    <button onclick="verDocumento('{{ $libro['file'] }}');"
                                                        class="btn btn-outline-success">Descargar libro</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        @else
            <div class="w-100 h-100 bg-light">
                <h1>Bienvenido {{ Auth::user()->name }} a la biblioteca escolar</h1>
                <p>Para comenzar a buscar los libros elige una universidad en la cual deseas consultar los libros</p>
            </div>
        @endif

    </div>

@endsection

@section('javascript')
    <script src="{{ asset('js/sweetalert/sweetalert2.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('js/jquery/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/utilidades.js') }}"></script>
    <script>
        // $(document).ready(function(){
        //     var select = document.getElementById("universidades");
        //     var valor = select.value;
        //     var form = document.getElementById('filtroForm');
        //     form.action = form.action.replace(':VarUniversidad', valor);
        // });
        // $("#universidades").on("change", function() {
        //     var selectedValue = this.value;
        //     var form = document.getElementById('filtroForm');
        //     form.action = form.action.replace(':VarUniversidad', selectedValue);
        // });

        document.getElementById('universidades').addEventListener('change', function() {
            var selectedValue = this.value;
            var form = document.getElementById('filtroForm');
            var originalAction = form.getAttribute('data-original-action');
            form.action = originalAction.replace('aquicolocar', selectedValue);
        });
    </script>
@endsection
