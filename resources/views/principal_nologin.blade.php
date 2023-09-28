@extends('plantillas/plantillaPreGral')

@section('title', 'Página principal')

@section('estilos', )

@section('contenido')
<link rel="stylesheet" href="{{asset('css/principal.css')}}">
    <div class="jumbotron jb-principal">
        <div class="container-fluid jumbotron-texto container">
            <h1 class="display-3">Contenido a tu alcance</h1>
            <p class="lead">Descubre un mundo de películas!</p>
        </div>
    </div>

    <br>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div  class="carousel-item active">

                <div id="e-carrusel-1" class="d-block elemento-carousel">
                    <div class="container">
                        @foreach ($upcomingMovies as $movie)
                            @if ($loop->index==1)
                                <div class="carruselGrid">
                                    {{-- <div class="col-1"></div> --}}
                                    <div class="carruselCol1">
                                        <img class="imgCarrusel" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="">
                                    </div>
                                    <div class="carruselCol2">
                                        <h1 class="display-3">{{ $movie['title'] }}</h1>
                                        <p class="mt-2">{{ $movie['overview'] }}</p>
                                    </div>
                                </div>
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="carousel-item">

                <div id="e-carrusel-2"  class="d-block elemento-carousel">
                    <div class="container">
                        @foreach ($upcomingMovies as $movie)
                            @if ($loop->index==2)
                                <div class="carruselGrid">
                                    {{-- <div class="col-1"></div> --}}

                                    <div class="carruselCol1">
                                        <img class="imgCarrusel" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="">
                                    </div>
                                    <div class="carruselCol2">
                                        <h1 class="display-3">{{ $movie['title'] }}</h1>
                                        <p class="mt-2">{{ $movie['overview'] }}</p>
                                    </div>
                                </div>

                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div  class="carousel-item">

                <div id="e-carrusel-3" class="d-block elemento-carousel">
                    <div class="container">
                        @foreach ($upcomingMovies as $movie)
                            @if ($loop->index==3)
                                <div class="carruselGrid">
                                    {{-- <div class="col-1"></div> --}}
                                    <div class="carruselCol1">
                                        <img class="imgCarrusel" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="">
                                    </div>
                                    <div class="carruselCol2">
                                        <h1 class="display-3">{{ $movie['title'] }}</h1>
                                        <p class="mt-2">{{ $movie['overview'] }}</p>
                                    </div>
                                </div>
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    
        <h2 class="mt-3 text-center mb-3">Populares</h2>

        <div class="movieGrid">

            @foreach ($popularMovies as $movie)
            <div class="mb-3">
                <x-movie-card-muestra :movie="$movie"/>
            </div>
                @if ($loop->index==6)
                    @break
                @endif
            @endforeach
            
        </div>
    

    @include('components.footer')

@endsection
