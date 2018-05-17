@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 mx-auto">
                    <div class="card card-default">
                        <div class="card-heading">
                            <h3 class="card-title text-center text-gray-dark">{!! trans('auth.register') !!}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'register', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                {!! Form::label('fullname', trans('auth.fullname'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::input('text', 'fullname', old('fullname'), ['class' => 'form-control', 'id' => 'name']) !!}
                                    @if ($errors->has('fullname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fullname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                {!! Form::label('username', trans('auth.username'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::input('text', 'username', old('username'), ['class' => 'form-control', 'id' => 'name']) !!}
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', trans('auth.email'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::input('email', 'email', old('email'), ['class' => 'form-control' ,'id' => 'email']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender','Gender',['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::select('gender',['male' => 'Male','female' => 'Female', 'undefined' => 'Undefined'], null, ['class' => 'form-control'])  !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', trans('auth.password'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password-confirm', trans('auth.password_confirm'),['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-12">
                                    {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'id' => 'password-confirm']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    {!! Form::button(trans('auth.register'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
