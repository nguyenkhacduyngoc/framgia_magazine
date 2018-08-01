<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/backend/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('css/backend/elegant-icons-style.css') }}" rel="stylesheet"/>
    <!-- Custom styles -->
    <link href="{{ asset('css/backend/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/style-responsive.css') }}" rel="stylesheet"/>
    @yield('backend-add-css')
</head>
<body>
<div id="app-backend">
<!-- container section start -->
    <section id="container" class="">
        <dash-board></dash-board>
    </section>
<!-- container section end -->
</div>
<!-- javascripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/backend/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('js/backend/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/scripts.js') }}"></script>

@yield('backend-add-js')
</body>
</body>
</html>
