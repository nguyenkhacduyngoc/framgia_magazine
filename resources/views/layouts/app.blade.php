<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content"
                aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse justify-content-end" id="nav-content">
            <ul class="navbar-nav">
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ trans('auth.login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ trans('auth.register') }}</a></li>
                @endguest
                @auth
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="Preview" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">{{ Auth::user()->fullname }}</a>
                        <div class="dropdown-menu " aria-labelledby="Preview">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            {!! Form::open(['route' => 'logout','method' => 'post','class' => 'form-horizontal', 'id' => 'logout-form']) !!}
                            {!! Form::close() !!}
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    @yield('content')
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
