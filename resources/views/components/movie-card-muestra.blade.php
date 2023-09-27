

<div class="pelicula-container p-1">

        <a href="{{route('principal.show',$movie['id'])}}">
            <img class="pelicula-lista" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="">
        </a>


    <div class="mt-2">
        <a href="{{route('principal.show',$movie['id'])}}" class="fw-semibold fs-6 titulo-lista">{{ $movie['title'] }}</a>
    </div>
</div>
