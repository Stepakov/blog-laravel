@props([
    'route',
    'method'=> 'GET'
    ])

<form action="{{ $route }}" method="{{ $method == "GET" ? "GET" : "POST" }}">
    @csrf
    @if( in_array( $method, [ 'PUT', 'PATCH', 'DELETE' ] ) )
        @method( $method )
    @endif

    {{ $slot }}
</form>
