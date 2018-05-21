@extends('backend.master')
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i></h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href=""></a></li>
                        <li><i class="fa fa-table"></i></li>
                        <li><i class="fa fa-th-list"></i></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            {!! trans('auth.user') !!}
                        </header>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="panel-body">
                            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('role', 'Role', ['class' => 'control-label col-lg-3' ]) !!}
                                <div class="col-lg-6">
                                    {!! Form::select('role', ['1' => 'Admin' , '0' => 'User'], $user->role, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender', ['class' => 'control-label col-lg-3' ]) !!}
                                <div class="col-lg-6">
                                    {!! Form::select('gender', ['male' => 'Male' , 'female' => 'Female', 'undefined' => 'Undefined'], $user->gender, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::button('Edit', ['type' => 'submit', 'class' => 'col-md-1 col-md-offset-5 btn btn-primary']) !!}
                                <a class="col-md-1 col-md-offset-1 btn btn-danger"
                                   href="{{ route('admin.users.index') }}">{!! 'Cancel' !!}</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection
