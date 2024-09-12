@props([
    'route',
    'method'=> 'GET',
    'enctype' => null,
    ])

<form
    action="{{ $route }}"
    method="{{ $method == "GET" ? "GET" : "POST" }}"
    @if( $enctype ) enctype="multipart/form-data" @endif
>
    @csrf
    @if( in_array( $method, [ 'PUT', 'PATCH', 'DELETE' ] ) )
        @method( $method )
    @endif

    {{ $slot }}
</form>
