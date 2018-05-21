@extends('frontend.master')
@section('add-css')
    {!! Html::style('css/backend/bootstrap-theme.css') !!}
    <!--external css-->
    <!-- font icon -->
    {!! Html::style('css/backend/elegant-icons-style.css') !!}
    <!-- Custom styles -->
    {!! Html::style('css/backend/style.css') !!}
    {!! Html::style('css/backend/style-responsive.css') !!}
@endsection
@section('content')
    <!--main content start-->
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
                </div>
            </div>
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4>Jenifer Smith</h4>
                                <div class="follow-ava">
                                    <img src="img/profile-widget-avatar.jpg" alt="">
                                </div>
                                <h6>Administrator</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>@jenifersmith</p>
                                <h6>
                                    <span><i class=""></i>Join At : </span>
                                    <span><i class=""></i>25.10.13</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#profile">
                                        <i class="icon-user"></i>
                                        {!! trans('auth.profile') !!}
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- profile -->
                                <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.fullname') !!} </span>: {!! $user->fullname !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.email') !!} </span>:{!! $user->email !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.address') !!} </span>: {!! $user->address !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.birthday') !!}</span>: {!! $user->birthday !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.job') !!} </span>: {!! $user->job !!}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.gender') !!} </span>: {!! $user->gender !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </div>
    </section>
@endsection
@section('add-js')
    {!! HTML::script('js/backend/jquery.scrollTo.min.js') !!}
    {!! HTML::script('js/backend/jquery.nicescroll.js') !!}
    {!! HTML::script('js/backend/scripts.js') !!}
    {!! HTML::script('js/backend/jquery.knob.js') !!}
    <script>
        //knob
        $(".knob").knob();
    </script>
@endsection
