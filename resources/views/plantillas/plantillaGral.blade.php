<!-- CREADO POR: Daniel Briseño -->
<!-- FECHA CREACIÓN: 10/03/2023-->
<!-- DESCRIPCIÓN: PLantilla para el uso general y creación de los demas diseños-->

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Ingreso de la información principal del HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Etiqueta para que puedan ingresar un titulo o se coloque uno por defecto -->
    <title>@yield('title', 'Biblioteca')</title>
    <!-- Referenciación de los archivos para los estilos -->
    <link href="{{ asset('js/bootstrap5.3.0/bootstrap.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <!-- Etiqueta para que puedan referenciar los archivos de estilos -->
    @yield('estilos')

    {{-- @livewireStyles --}}
    <script src="{{ asset('js/bootstrap5.3.0/bootstrap.js') }} "></script>
</head>

<body>
    <!-- Comienzo de la barra de navegación -->
    <nav style="z-index: 1000" class="navbar navbar-expand-lg navbar-light color-navegacion shadow">
        <div class="logo">
            <!-- Titulo de la página -->
            <h3 class="text-center text-white"><a href="{{ route('principal') }}" class="nav-link">Biblioteca
                    Escolar</a></h3>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            <!-- Es el botón para cuando el sitio se visualiice en celular -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarSupportedContent">
                @if (Auth::user()->typeUser == 'Admin')
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Link de navegación para página de nosotros -->
                        <li class="nav-item">
                            <a class="nav-link text-white p-3 enlace" aria-current="page"
                                href="{{ route('libro.index') }}">Libros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white p-3 enlace" aria-current="page"
                                href="{{ route('administrador.index') }}">Administradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white p-3 enlace" aria-current="page"
                                href="{{ route('alumno.index') }}">Alumnos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white p-3 enlace" aria-current="page"
                                href="{{ route('universidad.index') }}">Universidades</a>
                        </li>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </ul>
                @endif
                {{-- <div
                    class="search d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center">
                    <livewire:search-dropdown>
                </div> --}}
                <!-- Boton desplegable para opciones correspondientes a modificacion de perfil -->
                <div class="dropdown mt-1">
                    <div class="d-flex p-3 enlace align-items-center" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="ms-2">
                            {{ Auth::user()->nombre }} {{ Auth::user()->apPaterno }}
                            Sesión
                        </div>
                    </div>
                    <!-- Links para páginas de modificación de perfil -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- <li><a class="dropdown-item" href="{{ route('perfil') }}">Mi perfil</a></li>
                  <li><a class="dropdown-item" href="{{ route('historial.index') }}">Historial</a></li> --}}
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Fin de barra de navegación -->


    <!--  Etiqueta para que puedan desarrollar el contenido en cada diseño-->
    @yield('contenido')

    <!-- Etiqueta para que se utilice el paquete del sweetalert -->
    {{-- @include('sweetalert::alert') --}}

    <!-- Script principal -->
    @yield('javascript')

    {{-- @livewireScripts --}}
</body>

</html>
