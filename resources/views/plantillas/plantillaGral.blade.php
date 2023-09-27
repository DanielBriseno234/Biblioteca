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
    <title>@yield('title', 'NetMex')</title>
    <!-- Referenciación de los archivos para los estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <!-- Etiqueta para que puedan referenciar los archivos de estilos -->
    @yield("estilos")

    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

<body class="bg-dark text-white">
    <!-- Comienzo de la barra de navegación -->
    <div class="color-navegacion logo">
        <!-- Titulo de la página -->
        <h1 class="text-center text-white"><a href="{{ route('principal') }}" class="nav-link">NETMEX</a></h1>
    </div>
    <nav style="z-index: 1000" class="navbar navbar-expand-lg navbar-light color-navegacion">
        <div class="container-fluid d-flex justify-content-end">
          <!-- Es el botón para cuando el sitio se visualiice en celular -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
          </button>
          <div class="collapse navbar-collapse mt-2" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- Link de navegación para página de nosotros -->
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" aria-current="page" href="{{ route('nosotros') }}">Nosotros</a>
              </li>
              <!-- Link de navegación para página de contacto -->
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" href="{{ route('contacto') }}">Contacto</a>
              </li>
              <!-- Link de navegación para página de favoritos -->
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" href="{{ route('favoritos.index') }}">Favoritos</a>
              </li>
            </ul>
            <!-- Formulario para busqueda de películas -->
            @php
            @endphp
            <div class="search d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center">
                <livewire:search-dropdown>
            </div>
            <!-- Boton desplegable para opciones correspondientes a modificacion de perfil -->
            <div class="dropdown d-flex justify-content-end mt-1">
              <div class="d-flex p-3 enlace align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <a class=" imgPerfil">
                  <img src="../{{ Auth::user()->imagen }}" class="p"  alt=""
                    loading="lazy" />
                </a>
                <div class="ms-2">
                  {{Auth::user()->nombre}} {{Auth::user()->apPaterno}} 
                </div>
              </div>
                <!-- Links para páginas de modificación de perfil -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('perfil') }}">Mi perfil</a></li>
                  <li><a class="dropdown-item" href="{{ route('historial.index') }}">Historial</a></li>
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
  @include('sweetalert::alert')

  <!-- Script principal -->
  @yield('javascript')

  @livewireScripts
</body>
</html>
