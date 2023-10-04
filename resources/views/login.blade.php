<!-- CREADO POR: Daniel Briseño -->
<!-- FECHA CREACIÓN: 10/03/2023-->
<!-- DESCRIPCIÓN: Login para usuario -->

<!-- Extension de la plantilla para este diseño -->
@extends('plantillas/plantillaLogin')

<!-- Extension para colocar el titulo a este diseño -->
@section('title', 'Inicio de sesión')

<!-- Extension para colocar los estilos a este diseño  -->
@section('estilos')
  <link rel="stylesheet" href="css/login.css">
@endsection

<!-- Extensión para colocar todo el contenido correspondiente a este diseño -->
@section('contenido')
<!-- Comienzo del div -->
<div class="page-header header-filter imagenLogin"> <!-- Este div contiene la ia imagen de fondo -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <!-- Formulario de login para ingresar los datos para inicio de sesión -->
            <form class="form" name="login" method="POST" action="{{ route('inicia-sesion') }}">
              @csrf <!-- Este comando ayuda para informar a laravel que el formulario esta validado por el usuario -->
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
              </div>
              <div class="card-body px-3">
                <div>
                <div class="input-group">
                  <!-- Espacio para ingresar el name -->
                  {{-- <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div> --}}
                  <input type="email" id="email" class="form-control" placeholder="Email..." name="email" aria-describedby="nameHelp" value="{{ old('name') }}">
                </div>
                <!-- Captura de error -->
                  {!! $errors->first('email','<small class="error ms-5">:message</small>') !!}
                </div>
                <div>
                <div class="input-group">
                  <!-- Espacio para ingresar la contraseña -->
                  {{-- <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div> --}}
                  <input type="password" class="form-control" placeholder="Contraseña..."  name="password">
                </div>
                <!-- Captura de error -->
                  {!! $errors->first('password','<small class="error ms-5">:message</small>') !!}
                </div>
                <div class="input-group justify-content-center">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" class="form-check-input" id="rememberCheck">
                        </span>
                      </div>

                    <label class="form-check-label" name="remember" for="rememberCheck">Mantener la sesion iniciada?</label>
                </div>

              </div>
              <div class="footer text-center mb-2">
                <!-- Boton para enviar el formulario -->
                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Iniciar Sesión</button>
                <!-- Si el usuario no tiene cuenta este espacio lo redireccionara para registrarse -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

<!-- Extención para colocar los archivos de Javascript que se utilicen en este diseño -->
@section('javascript')
  <script src="js/login.js"></script>
@endsection
