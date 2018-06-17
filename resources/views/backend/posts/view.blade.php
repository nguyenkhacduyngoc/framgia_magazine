@extends('backend.master')
@section('backend-content')
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
	    <!-- News Details -->
	    <section class="news-details">
	        <div class="container">
	        	<div class="row">
	                <div class="col-lg-12">
	                    <section class="panel">
	                        <header class="panel-heading">
	                            {!! trans('auth.posts') !!}
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
	                        @if(Session::has('status'))
	                        <div class="alert alert-danger">
	                                <ul>
	                                    <li>{{ Session::get('status') }}</li>
	                                </ul>
	                            </div>
							@endif
	                        <div class="panel-body">
	                            {!! Form::model($post, ['route' => ['admin.posts.update', $post->slug], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
	                            <div class="form-group">
	                                {!! Form::label('category',trans('auth.category'),['class' => 'col-sm-3 control-label']) !!}
	                                <div class="col-sm-7">
	                                    {!! Form::select('category_id', $categories_array , null, ['class' => 'form-control m-bot15'])  !!}
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('slider', 'Chose Slider', ['class' => 'col-sm-3 control-label']) !!}
	                                <div class="col-sm-7">
	                                    {!! Form::select('slider', $slider_option_array, $post->slider, ['class' => 'form-control m-bot15']) !!}
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
	            <div class="row">
	                <div class="offset-lg-1 col-lg-9 col-md-12">
	                <h4>POST REVIEW</h4>
	                    <div class="news-heading">
	                        <h4>{{ $post->title }}</h4>
	                        <ul class="list-unstyled list-inline">
	                            <li class="list-inline-item"><i class="fa fa-user"></i><a href="#"> {!! ($post->user == null) ? null : $post->user->fullname !!} </a>
	                            </li>
	                            <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ $post->created_at }} </li>
	                            <li class="list-inline-item"><i class="fa fa-comments"></i><a
	                                        href="#"> {{ trans('auth.number') }} {{ trans('auth.comments') }} </a></li>
	                        </ul>
	                        {{-- <img src="{{ asset(config('config.link_upload_file').$post->img) }}" alt="" class="post_img img-fluid"> --}}
	                        {!! $post->content !!}
	                    </div>
	                    <div class="row">
	                        <div class="col-md-7">
	                            <div class="social-share">
	                                <ul class="list-unstyled list-inline">
	                                    <li class="list-inline-item"><a href="#">{{ trans('auth.home') }}</a></li>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="col-md-5">
	                            <div class="news-tag text-right">
	                                <ul class="list-unstyled list-inline">
	                                    <li class="list-inline-item">{{ trans('auth.tags') }}:</li>
	                                    @foreach($post->tags as $tag)
	                                        <li class="list-inline-item"><a href="#">#{!! $tag->content !!}</a></li>
	                                    @endforeach
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="news-author">
	                        <img src="images/author.jpg" alt="" class="img-fluid">
	                        <h6>{{ trans('auth.author') }}: <span>{!! ($post->user == null) ? null : $post->user->fullname !!}</span></h6>
	                        <ul class="list-unstyled list-inline">
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
	                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
<!-- End News Details -->
	</section>
</section>
@endsection
