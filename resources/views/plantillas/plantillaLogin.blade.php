<!-- CREADO POR: Daniel Briseño -->
<!-- FECHA CREACIÓN: 10/03/2023-->
<!-- DESCRIPCIÓN: Plantilla para creacion del formulario de login y de registro -->

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Ingreso de la información principal del HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Etiqueta para que puedan ingresar un titulo o se coloque uno por defecto -->
    <title>@yield('title', 'D.J.L Technologies')</title>
    <!-- Referenciación de los archivos para los estilos -->
    <link rel="stylesheet" href="css/estilos.css">
    <link href="{{ asset('js/bootstrap5.3.0/bootstrap.css') }}" rel="stylesheet">
    <!-- Etiqueta para que puedan referenciar los archivos de estilos -->
    @yield('estilos')
</head>
<body>
    <!--  Etiqueta para que puedan desarrollar el contenido en cada diseño-->
    @yield("contenido")

    <!-- Footer para todos los diseños -->
    <footer class="footer text-center ">
        <p class="fw-bold">D.J.L Technologies 2023</p>
    </footer>

    <!-- Script principal -->
    <script src="{{ asset('js/bootstrap5.3.0/bootstrap.js') }} "></script>
</body>
</html>