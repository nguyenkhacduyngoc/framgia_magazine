@extends('backend.master')
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i> {{ trans('admin.categories') }} </h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html"> {{ trans('admin.admin') }} </a></li>
                        <li><i class="fa fa-table"></i> {{ trans('admin.categories') }} </li>
                        <li><i class="fa fa-th-list"></i> {{ trans('admin.create_category') }} </li>
                    </ol>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            {{ trans('admin.create_category') }}
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
                            {!! Form::open(['route' => 'categories.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-7">
                                    {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'Name'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-7">
                                    {!! Form::input('text', 'description', null, ['class' => 'form-control', 'placeholder' => 'Description'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::button('Create', ['type' => 'submit', 'class' => 'col-md-1 col-md-offset-5 btn btn-primary']) !!}
                                <a class="col-md-1 col-md-offset-1 btn btn-danger"
                                   href="{{ route('categories.index') }}"> {!! 'Cancel' !!} </a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </section>
                </div>
            </div>
            <!-- Basic Forms & Horizontal Forms-->

            <!-- page end-->
        </section>
    </section>
@endsection
