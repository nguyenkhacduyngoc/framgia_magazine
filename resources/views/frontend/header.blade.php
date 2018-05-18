<!-- Pre-Loader -->
{{-- <div id="page-preloader"><span class="spinner"></span></div> --}}
<!-- End Pre-Loader -->

<!-- Top Bar -->
<section class="top-bar">
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
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

                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="Preview" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->fullname }}</a>
                            <div class="dropdown-menu " aria-labelledby="Preview">
                                <a class="dropdown-item"
                                   href="{{ route('posts.create') }}">{{ trans('auth.create_post') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ trans('auth.logout') }}</a>
                                {!! Form::open(['route' => 'logout','method' => 'post','class' => 'form-horizontal', 'id' => 'logout-form']) !!}
                                {!! Form::close() !!}
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- End Top Bar -->

<!-- Logo Area -->
<section class="logo-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <a href="#"><img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="searchbar text-right">
                    {!! Form::open(['route' =>'login', 'method' => 'post', 'class' => '']) !!}
                    {!! Form::input('text', 'search', null, ['class' => 'form-control', 'placeholder' => 'Search Here']) !!}
                    {!! Form::button(trans('auth.search'), ['type' => 'submit', 'class' => 'btn btn-primary col-md-5' ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Logo Area -->

<section class="menu-area">
    <div class="container">
        <div class="menu-content">
            <div class="row">
                <div class="col-lg-10 col-md-12">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item active"><a
                                    href="{{ route('homepage') }}">{{ trans('auth.home') }}</a></li>
                        <li class="list-inline-item"><a>{{ trans('auth.home') }}<i class="fa fa-angle-down"></i></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('homepage') }}">{{ trans('auth.home') }}</a></li>
                                <li><a href="{{ route('homepage') }}">{{ trans('auth.home') }}<i
                                                class="fa fa-angle-right"></i></a>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ route('home') }}">{{ trans('auth.home') }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="list-inline-item static"><a>{{ trans('auth.home') }}<i class="fa fa-angle-down"></i></a>
                            <ul class="mega-menu list-unstyled">
                                <li>
                                    <h4>{{ trans('auth.home') }}</h4>
                                    <a href="#">{{ trans('auth.home') }}</a>
                                </li>
                                <li>
                                    <h4>{{ trans('auth.home') }}</h4>
                                    <a href="#">{{ trans('auth.home') }}</a>
                                </li>
                                <li>
                                    <h4></h4>
                                    <a href="#">{{ trans('auth.home') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-inline-item"><a href="#">{{ trans('auth.home') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-12">
                    <div class="clock text-right">
                        <span id="dg-clock"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Menu -->
<section class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <a href="#"><img src="{{ asset('images/mobile-logo.png') }}" alt="" class="img-fluid"></a>
                        <a href="#"><i class="fa fa-home"></i></a>
                        <ul>
                            <li class="list-inline-item"><a href="#">{{ trans('auth.home') }}</a></li>
                            <li class="list-inline-item"><a href="#">{{ trans('auth.home') }}</a>
                                <ul class="list-unstyled">
                                    <li><a href="#">{{ trans('auth.home') }}</a></li>
                                </ul>
                            </li>
                            <li class="list-inline-item"><a href="#">{{ trans('auth.home') }}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Mobile Menu -->

<!-- Web Ticker -->
<section class="top-news">
</section>
<!-- End Web Ticker -->
