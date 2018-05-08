<!doctype html>
<html class="no-js" lang="zxx">
<head>
    @yield('add-css')
</head>
<body>
    @include('frontend.header')
    @yield('content')
    @include('frontend.footer')
    @yield('add-js')
</body>

</html>
