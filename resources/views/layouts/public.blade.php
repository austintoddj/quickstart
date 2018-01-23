<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>

        @if(!empty(env('GOOGLE_ANALYTICS')))
            @include('public.components.analytics.tracking')
        @endif
    </body>
</html>
