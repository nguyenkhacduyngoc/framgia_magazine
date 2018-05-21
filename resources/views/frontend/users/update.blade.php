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
                    <h3 class="page-header"><i class="fa fa-user-md"></i> {!! trans('auth.profile') !!}</h3>
                </div>
            </div>
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4>{!! $user->fullname !!}</h4>
                                <div class="follow-ava">
                                    {!! Html::image(config('config.link_upload_file').$user->avatar) !!}
                                    {{-- <img src="{!! (config('config.link_upload_file').$user->avatar) !!}" alt=""> --}}
                                </div>
                                <h6>{!! trans('auth.administrator') !!}</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p> {!! '@'.$user->username !!}</p>
                                <h6>
                                    <span><i class=""></i>{!! trans('auth.join_at') !!} : </span>
                                    <span><i class=""></i>{!! $user->created_at !!}</span>
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
                                    <a data-toggle="tab" href="#edit-profile">
                                        <i class="icon-envelope"></i>
                                        {!! trans('auth.edit_profile') !!}
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- edit-profile -->
                                <div id="edit-profile" class="tab-pane active">
                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">
                                            <h1> {{ trans('auth.profile') }}</h1>
                                            {!! Form::model($user,['route' => ['user.update', $user->id],'method' => 'patch','class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                                            <div class="form-group form-row">
                                                {!! Form::label('fullname',trans('auth.fullname'),['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::input('text', 'fullname', null, ['class' => 'form-control', 'placeholder' => trans('auth.fullname')])  !!}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                {!! Form::label('email',trans('auth.email'),['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('auth.email')])  !!}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                {!! Form::label('gender',trans('auth.gender'),['class' => 'col-sm-2 control-label col-form-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::select('gender', $user_gender , null, ['class' => 'form-control'])  !!}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                {!! Form::label('address',trans('auth.address'),['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::input('text', 'address', null, ['class' => 'form-control', 'placeholder' => trans('auth.address')])  !!}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                {!! Form::label('job',trans('auth.job'),['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::input('text', 'job', null, ['class' => 'form-control', 'placeholder' => trans('auth.job')])  !!}
                                                </div>
                                            </div>
                                            <div class="form-group form-row">
                                                {!! Form::label('avatar', trans('auth.avatar'),['class' => 'col-sm-2 control-label']) !!}
                                                <div class="col-lg-10">
                                                    {!! Form::file('avatar')  !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="mx-auto col-md-12">
                                                    {!! Form::button(trans('auth.create'), ['type' => 'submit','class' => 'btn btn-primary col-md-2 offset-4']) !!}
                                                    <a class="btn btn-danger offset-1 col-md-2"
                                                       href="{{ route('homepage') }}">{!! trans('auth.cancel') !!}</a>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
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
