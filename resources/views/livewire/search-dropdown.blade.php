<div style="position: relative;">

    <input wire:model.debounce.500ms="search" class="form-control px-4 ps-5" type="search" placeholder="Search" aria-label="Search">
    <i style="position:absolute; top:0px; color:purple;" class="fa-solid fa-magnifying-glass mt-2 ms-2"></i>
    <div style="position: absolute; width: 100%;" class="bg-dark mt-2">
        <ul style="padding: 0px; margin: 0px; z-index: 1000000;">
            @foreach ($searchResults as $result)
                <li style="list-style: none; margin:0px;" class="border-bottom ">
                    <a id="fl" style="text-decoration: none; color:white;" class="d-block px-3 py-3" href="{{ route('principal.show', $result['id']) }}">{{ $result['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
