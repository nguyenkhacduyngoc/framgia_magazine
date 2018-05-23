@extends('frontend.master')
@section('add-css')
    {!! Html::style('css/frontend/tagsinput.css') !!}
@endsection
@section('content')
    <!--main content start-->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i>{{ trans('auth.home') }}</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">{{ trans('auth.home') }}</a></li>
                        <li><i class="icon_document_alt"></i>{{ trans('auth.home') }}</li>
                        <li><i class="fa fa-file-text-o"></i>{{ trans('auth.home') }}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <section class="card">
                        <header class="card-heading">
                        </header>
                        <div class="card-body mx-auto col-md-12">
                            {!! Form::model($post,['route' => ['posts.update', $post->id],'method' => 'patch','class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group form-row">
                                {!! Form::label('category',trans('auth.category'),['class' => 'col-sm-2 control-label col-form-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::select('category', $categories_array , null, ['class' => 'form-control'])  !!}
                                </div>
                            </div>
                            <div class="form-group form-row">
                                {!! Form::label('title',trans('auth.title'),['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => trans('auth.title')])  !!}
                                </div>
                            </div>
                            <div class="form-group form-row">
                                {!! Form::label('subtitle',trans('auth.subtitle'),['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::input('text', 'subtitle', null, ['class' => 'form-control', 'placeholder' => trans('auth.subtitle')])  !!}
                                </div>
                            </div>
                            <div class="form-group form-row">
                                {!! Form::label('image', trans('auth.upload_img'),['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::file('image')  !!}
                                </div>
                            </div>
                            <div class="form-group form-row">
                                {!! Form::label('content',trans('auth.content'),['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::textarea('content', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Subtitle', 'rows'=> '6'])  !!}
                                </div>
                            </div>
                            <div class="form-group form-row">
                                {!! Form::label('tag', trans('auth.tags'),['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::input('text', 'tag', implode(',', $tags_array), ['class' => 'form-control', 'placeholder' => trans('auth.tags'), 'data-role'=> 'tagsinput'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-md-12">
                                    {!! Form::button(trans('auth.update'), ['type' => 'submit','class' => 'btn btn-primary col-md-2 offset-4']) !!}
                                    <a class="btn btn-danger offset-1 col-md-2"
                                       href="{{ route('homepage') }}">{!! trans('auth.cancel') !!}</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </div>
    </section>
@endsection
@section('add-js')
    {!! Html::script('js/frontend/ckeditor/ckeditor.js') !!}
    {!! Html::script('js/frontend/tagsinput.js') !!}
@endsection
