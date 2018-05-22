<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    {!! Html::style('css/app.css') !!}
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <!-- Animate CSS -->
    {!! Html::style('css/frontend/animate.css') !!}
    <!-- Mean Menu -->
    {!! Html::style('css/frontend/meanmenu.min.css') !!}
    <!-- Owl Carousel -->
    {!! Html::style('css/frontend/owl.carousel.min.css') !!}
    <!-- Magnific Popup -->
    {!! Html::style('css/frontend/magnific-popup.css') !!}
    <!-- Custom Style -->
    {!! Html::style('css/frontend/normalize.css') !!}
    {!! Html::style('css/frontend/style.css') !!}
    {!! Html::style('css/frontend/responsive.css') !!}
    {{-- {!! Html::style('css/backend/bootstrap-theme.css') !!} --}}
    @yield('add-css')
</head>
<body>
<div id="app"></div>
@include('frontend.header')
@yield('content')
@include('frontend.footer')

<!-- =========================================
    JavaScript Files
    ========================================== -->
{!! HTML::script('js/app.js') !!}
<!-- Sticky Js -->
{!! HTML::script('js/frontend/jquery.sticky.js') !!}

<!-- WOW JS -->
{!! HTML::script('js/frontend/wow.min.js') !!}

<!-- Smooth Scroll -->
{!! HTML::script('js/frontend/smooth-scroll.js') !!}

<!-- Mean Menu -->
{!! HTML::script('js/frontend/jquery.meanmenu.min.js') !!}

<!-- News Ticker -->
{!! HTML::script('js/frontend/jquery.newsticker.min.js') !!}

<!-- Owl Carousel -->
{!! HTML::script('js/frontend/owl.carousel.min.js') !!}

<!-- Magnific Popup -->
{!! HTML::script('js/frontend/jquery.magnific-popup.min.js') !!}

<!-- Syotimer -->
{!! HTML::script('js/frontend/jquery.syotimer.min.js') !!}

<!-- Custom JS -->
{!! HTML::script('js/frontend/plugins.js') !!}
{!! HTML::script('js/frontend/custom.js') !!}

@yield('add-js')
</body>

</html>
