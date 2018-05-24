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
                            {!! trans('admin.create_category') !!}
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
                            {!! Form::model($post, ['route' => ['admin.posts.update', $post->slug], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-7">
                                    {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Name', 'readonly'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-7">
                                    {!! Form::select('status', ['Pending', 'Rejected', 'Accepted'], $post->status, ['class' => 'form-control m-bot15']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::button('Update', ['type' => 'submit', 'class' => 'col-md-1 col-md-offset-5 btn btn-primary']) !!}
                                <a class="col-md-1 col-md-offset-1 btn btn-danger" href="{{ route('admin.posts.index') }}">{!! 'Cancel' !!}</a>
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
