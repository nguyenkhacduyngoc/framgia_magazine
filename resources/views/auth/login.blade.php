@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6 mx-auto">
                    <div class="card card-default">
                        <div class="card-heading">
                            <h3 class="card-title text-center text-gray-dark">{!! trans('auth.login') !!}</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body ">
                            {!! Form::open(['route' =>'login', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                {!! Form::label('username', trans('auth.username'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-lg-12">
                                    {!! Form::input('text', 'username', old('username'), ['class' => 'form-control']) !!}
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group btn-{{ $errors->has('password') ? 'has-error' : '' }}">
                                    {!! Form::label('password', trans('auth.password'), ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-lg-12">
                                        {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>{!! Form::checkbox('remmember', old('remember')) !!}{!! trans('auth.remember_me') !!}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mx-auto col-md-12">
                                        {!! Form::button(trans('auth.login'), ['type' => 'submit', 'class' => 'btn btn-primary col-md-5' ]) !!}
                                        <a class="btn btn-success offset-1 col-md-5" href="{{ route('register') }}">
                                            {!! trans('auth.register') !!}
                                        </a>
                                    </div>
                                    <div class="mx-auto col-md-12 text-center">
                                        <a class="btn btn-link text-center"
                                           href="{{ route('password.request') }}">{!! trans('auth.password_forget') !!}</a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
