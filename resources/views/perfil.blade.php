<!-- CREADO POR: Daniel Briseño -->
<!-- FECHA CREACIÓN: 10/03/2023-->
<!-- DESCRIPCIÓN: Vista para que el usuario modifique su perfil -->

<!-- Extension de la plantilla para este diseño -->
@extends('plantillas/plantillaGral')

<!-- Extension para colocar el titulo a la pagina -->
@section('title', 'Perfil')

<!-- Extension para colocar los estilos a este diseño  -->
@section('estilos')
    <link rel="stylesheet" href="css/perfil.css">
@endsection

<!-- Extensión para colocar todo el contenido correspondiente a este diseño -->
@section('contenido')
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <!-- Este espacio permite mostrar y cambiar la imagen de perfil del usuario -->
                <div class="profile-img">
                    <!-- Formulario para coambiar la imagen -->
                    <form action="{{ route('cambiar-imagen') }}" name="formulario" method="post"
                        enctype="multipart/form-data">
                        @csrf <!-- Este comando ayuda para informar a laravel que el formulario esta validado por el usuario -->
                        <img src="{{ Auth::user()->imagen }}" alt="" /> <!-- Muestra la imagen que actualmente tiene el ususario -->
                        <div class="file btn btn-lg btn-file">
                            Change Photo
                            <input type="file" name="imagen" />
                            <span id="error"></span>
                        </div>
                    </form>
                    {!! $errors->first('imagen','<small class="text-danger fw-bold">:message</small><br>') !!}
                </div>
            </div>
            <!-- Fin de formulario para comabiar imagen de perfil -->

            <!-- Comienzo de espacio para realizar donaciones voluntarias por Paypal -->
            <div class="col-md-8 text-dark">
                <div class="profile-head">
                    <div id="donate-button-container" class="border rounded p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Para nosotros es importante seguir creciendo</h5>
                                <p style="margin: 0">Por ello te agradeceriamos cualquier donación para seguir avanzando</p>
                            </div>
                            <!-- Este div contiene el boton para abrir el modal de donaciones -->
                            <div id="donate-button"></div>
                        </div>
                        <!-- Scrip generado por Paypal -->
                        <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                        <!-- Este script contiene los datos correspondientes a la cuenta registrada en paypal -->
                        <script>
                            PayPal.Donation.Button({
                                env: 'production',
                                hosted_button_id: 'E9QR8JY3VZUC4',
                                image: {
                                    src: 'https://www.paypalobjects.com/es_XC/i/btn/btn_donate_LG.gif',
                                    alt: 'Donar con el botón PayPal',
                                    title: 'PayPal - The safer, easier way to pay online!',
                                }
                            }).render('#donate-button');
                        </script>
                    </div>
                    <!-- Fin de espacio para donaciones -->

                    <!-- Comienzo de espacios donde se muestra la información del usuario y podrá cambiar sus datos -->
                    <h5 class="mt-3">
                        {{ Auth::user()->nombre }} {{ Auth::user()->apPaterno }} {{ Auth::user()->apMaterno }}
                    </h5>
                    <h6>
                        Usuario de la plataforma NetMex
                    </h6>
                    <nav>
                        <!-- Espacio donde se muestra la información del usuario -->
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active text-dark" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Datos</button>
                            <button class="nav-link text-dark" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Modificar información</button>
                            <button class="nav-link text-dark" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Cambiar Contraseña</button>
                        </div>
                    </nav>

                </div>

                <div class="tab-content" id="nav-tabContent">
                    <!-- Comienzo de los datos del usuario en donde se muestran con ayuda del AUTH -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Id</label>
                            </div>
                            <!-- ID del ususario -->
                            <div class="col-md-8">
                                <p>{{ Auth::user()->id }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Nombre dell usuario -->
                            <div class="col-md-4 fw-bold">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->nombre }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Apellido paterno del ususario -->
                            <div class="col-md-4 fw-bold">
                                <label>Apellido Paterno</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->apPaterno }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Apellido materno del usuario -->
                            <div class="col-md-4 fw-bold">
                                <label>Apelido Materno</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->apMaterno }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Email del ususario -->
                            <div class="col-md-4 fw-bold">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Username del ususario -->
                            <div class="col-md-4 fw-bold">
                                <label>Username</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->username }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de los datos del usuario -->

                    <!-- Comienzo del formulario para cambiar los datos del usuario -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form method="POST" action="{{ route('modificar-datos') }}">
                            @csrf <!-- Este comando ayuda para informar a laravel que el formulario esta validado por el usuario -->
                            <div class="row">
                                <!-- Apartado para ingresar el nombre -->
                                <div class="col-md-3 fw-bold">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Nombre..." id="nombre"
                                        name="nombre" aria-describedby="emailHelp" value="{{ Auth::user()->nombre }}">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('nombre', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <!-- Apartado para ingresar el apellido paterno -->
                                <div class="col-md-3 fw-bold">
                                    <label>Apellido Paterno</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Apellido Paterno..."
                                        id="apPaterno" name="apPaterno" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->apPaterno }}">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('apPaterno', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <!-- Apartado para ingresar el apellido materno -->
                                    <label>Apellido Materno</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="apMaterno"
                                        placeholder="Apellido Materno..." name="apMaterno" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->apMaterno }}">
                                    {!! $errors->first('apMaterno', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <!-- Apartado para ingresar el email -->
                                <div class="col-md-3 fw-bold">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="Email..." name="email"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('email', '<small class="error">:message</small>') !!}
                                </div>

                            </div>
                            <div class="row pt-1">
                                <!-- Apartado para ingresar el username -->
                                <div class="col-md-3 fw-bold">
                                    <label>Username</label><br />
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="username" placeholder="Username..."
                                        name="username" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->username }}">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('username', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <!-- Boton para enviar el formulario -->
                            <div class="footer text-center">
                                <button type="submit" class="profile-edit-btn mt-2">Modificar</button>
                            </div>
                        </form>
                    </div>
                    <!-- Fin de formulario para cambiar datos del usuario -->

                    <!-- Comienzo de formulario para cmbiar la contraseña -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form method="POST" action="{{ route('cambiar-contrasena') }}">
                            @csrf <!-- Este comando ayuda para informar a laravel que el formulario esta validado por el usuario -->
                            <div class="row">
                                <!-- Apartado para ingresar la contraseña que actualmente tiene el usuario -->
                                <div class="col-md-3 fw-bold">
                                    <label>Contraseña actual</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="passActual"
                                        placeholder="Contraseña Actual..." id="passActual">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('passActual', '<small class="error">:message</small>') !!}
                                </div>

                            </div>
                            <div class="row pt-1">
                                <!-- Apartado para ingresar la nueva contraseña del usuario -->
                                <div class="col-md-3 fw-bold">
                                    <label>Nueva Contraseña</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="passNueva"
                                        placeholder="Nueva Contraseña..." id="passNueva">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('passNueva', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <!-- Apartado para confirmar la nueva contraseña -->
                                    <label>Confirmar contraseña</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="Confirmar Contraseña..."
                                        id="passConfirmar" name="passConfirmar">
                                        <!-- Captura de errores -->
                                        {!! $errors->first('passConfirmar', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <!-- Boton para enviar el formulario -->
                            <div class="footer text-center">
                                <button type="submit" class="profile-edit-btn mt-2">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Este script captura un error y muestra una alrta en caso de que exista el error -->
    {{-- @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se pudo realizar la modificación. Por favor revisa que toda la información este completa y vuelve a intentarlo.',
            })
        </script>
    @endif --}}

    

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se pudo realizar la modificación. Por favor revisa lo ingresado y vuelve a intentarlo.' ,
            })
        </script>
    @endif

    @include('components.footer')
@endsection

<!-- Extención para colocar los archivos de Javascript que se utilicen en este diseño -->
@section('javascript')
    <script src="js/envioForm.js"></script>
@endsection
