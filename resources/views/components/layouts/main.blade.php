@props([
    'title',
    'h1' => null,
    ])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite( [ 'resources/css/app.scss' ] )
</head>
<body>
<header class="my-3">
    <div class="container">
        <div class="row">
            <div class="col col-9">Header</div>
            <div class="col col-3">
                @auth
                    <span>
                        {{ auth()->user()->name }}
                    </span>
                    <x-form route="{{ route( 'admin.users.logout' ) }}" method="POST" >
                        <button class="btn btn-primary">Logout</button>
                    </x-form>
                @else
                    <a href="{{ route( 'admin.users.register') }}">Registration</a>
                    <a href="{{ route( 'admin.users.login') }}">Login</a>
                @endif
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col col-3">
                @include( 'admin.layouts.sidebar' )
            </div>
            <div class="col col-9">
                @include( 'layouts.notifications' )
                <h1>{{ $h1 ?? $title }}</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <div class="row">
            Footer
        </div>
    </div>
</footer>

@vite( [ 'resources/js/app.js' ] )
</body>
</html>
