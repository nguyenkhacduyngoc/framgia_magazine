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
	                <div class="offset-lg-1 col-lg-9 col-md-12">
	                    <div class="news-heading">
	                        <h4>{{ $post->title }}</h4>
	                        <ul class="list-unstyled list-inline">
	                            <li class="list-inline-item"><i class="fa fa-user"></i><a href="#"> {{ $post->user->fullname }} </a>
	                            </li>
	                            <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ $post->created_at }} </li>
	                            <li class="list-inline-item"><i class="fa fa-comments"></i><a
	                                        href="#"> {{ trans('auth.number') }} {{ trans('auth.comments') }} </a></li>
	                        </ul>
	                        <img src="{{ asset('upload/posts/'.'/'.$post->img) }}" alt="" class="img-fluid">
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
	                        <h6>{{ trans('auth.author') }}: <span>{{ $post->user->fullname }}</span></h6>
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
