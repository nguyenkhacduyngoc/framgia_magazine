@extends('frontend.master')
@section('content')
    <!-- Page Heading -->
    <section class="p-heading text-center">
        <div class="container">
            <div class="page-bg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-content">
                            <h4>{{ trans('auth.post') }}</h4>
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"><a
                                            href="{{ route('homepage') }}">{{ trans('auth.homepage') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Heading -->

    <!-- News Details -->
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="news-heading">
                        <h4>{{ $post->title }}</h4>
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><i class="fa fa-user"></i><a
                                        href="#">{{ $post->user->fullname }}</a>
                            </li>
                            <li class="list-inline-item"><i class="fa fa-calendar"></i>{{ $post->created_at }}</li>
                            <li class="list-inline-item"><i class="fa fa-comments"></i><a href="#"> {!! $post->comments->count() !!} {{ trans('auth.comments') }} </a></li>
                        </ul>
                        <img src="{{ asset('upload/posts/'.'/'.$post->img) }}" alt="" class="post_img img-fluid">
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
                        <h6> {{ trans('auth.author') }}: <span>{{ $post->user->fullname }} </span></h6>
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <div class="news-comment">
                        <h4>{{ trans('auth.comments') }} <span>({!! $post->comments->count() !!})</span></h4>
                        @foreach($post->comments as $comment)
                        <div class="comment-box d-flex">
                            <div class="comment-img">
                                {!! Html::image(config('config.link_avatar').'/'.$comment->user->avatar, 'avatar', ['class' => 'img-fluid']) !!}
                            </div>
                            <div class="img-content">
                                <h6><a href="#">{!! $comment->user->fullname !!}</a> {!! $comment->created_at !!}</h6>
                                <p>{!! $comment->content !!}</p>
                                <span><a href="#">{!! trans('auth.reply') !!}</a></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="comment-reply">
                        <h4>{{ trans('auth.comments') }}</h4>
                        {!! Form::open(['route' => ['comments.store_comment', $post->id] ,'method' => 'post', 'id' => 'ajax-contact']) !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'COMMENT'])  !!}</p>
                                </div>
                                <div class="col-lg-12">
                                    <p>{!! Form::button('Submit', ['type' => 'submit']) !!}</p>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="relate-news">
                        <h4>{{ trans('auth.related_news') }}</h4>
                    </div>
                </div>
                @include('frontend.sidebar')
            </div>
        </div>
    </section>
    <!-- End News Details -->
@endsection
