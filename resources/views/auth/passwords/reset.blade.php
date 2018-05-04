@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{!! trans('auth.password_reset') !!}</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'password.request', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        {!! Form::input('hidden', 'token', $token) !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', trans('auth.email') , ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('email', 'email' , $email, ['class' => 'form-control', 'id' => 'email']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', trans('auth.password') , ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('password-confirm', trans('auth.password_confirm', ['class' => 'col-md-4 control-label'])) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'id' => 'password-confirm']) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::button(trans('auth.reset_password'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
