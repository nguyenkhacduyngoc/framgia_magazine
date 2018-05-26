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
                            <li class="list-inline-item"><i class="fa fa-user"></i><a href="#">{{ $post->user ? $post->user->fullname : null }}</a>
                            </li>
                            <li class="list-inline-item"><i class="fa fa-calendar"></i>{{ $post->created_at }}</li>
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
                        <h6> {{ trans('auth.author') }}: <span>{{ $post->user ? $post->user->fullname : null }} </span></h6>
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <div class="comment-area">
                        <div class="comment-reply">
                            <h4>{{ trans('auth.comments') }}</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p><textarea name="content" class="comment-content" id="" cols="90" rows="5" ></textarea></p>
                                </div>
                                <div class="col-lg-12">
                                    <p><button id='{!! $post->slug !!}' class="comment btn btn-success">{!! trans('auth.comments') !!}</button></p>
                                </div>
                            </div>
                        </div>
                        <div class="news-comment">
                            <h4>{{ trans('auth.comments') }} <span>({!! $post->comments->count() !!})</span></h4>
                            @foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                                <div class="comment-box d-flex">
                                    <div class="comment-img">
                                        {!! Html::image(config('config.link_avatar').'/'.$comment->user->avatar, 'avatar', ['class' => 'img-fluid']) !!}
                                    </div>
                                    <div class="img-content">
                                        <h6><a href="#">{!! $comment->user->fullname !!}</a> {!! $comment->created_at !!}</h6>
                                        <p>{!! $comment->content !!}</p>
                                        <span><a class="reply" data-id="{{ $comment->id }}" onclick="showHide('replycomment-{{ $comment->id }}');">{!! trans('auth.reply') !!}</a></span>
                                    </div>
                                </div>
                                @foreach($comment->comment()->orderBy('created_at', 'asc')->get() as $rep_comment)
                                <div class="comment-box comment-box2 d-flex">
                                    <div class="comment-img">
                                        {!! Html::image(config('config.link_avatar').'/'.$rep_comment->user->avatar, 'avatar', ['class' => 'img-fluid']) !!}
                                    </div>
                                    <div class="img-content">
                                        <h6><a href="#">{!! $rep_comment->user->fullname !!}</a> {!! $rep_comment->created_at !!}</h6>
                                        <p>{!! $rep_comment->content !!}</p>
                                        <span><a data-id="{{ $comment->id }}" onclick="showHide('replycomment-{{ $comment->id }}');">{!! trans('auth.reply') !!}</a></span>
                                    </div>
                                </div>
                                @endforeach
                                <div class="comment-reply hidden" id="{!! 'replycomment-'.$comment->id !!}">
                                    <div class="col-lg-12">
                                        <p><textarea name="content" class="" id="reply-content-{!! $comment->id !!}" cols="90" rows="5" ></textarea></p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p><button id='{!! $comment->id !!}' data-id='{!! $post->slug !!}' class="reply-comment btn btn-success">{!! trans('auth.reply') !!}</button></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
@section('add-js')
{!! Html::script('js/frontend/test.js') !!}
<script type="text/javascript">
    function showHide(id){
        $("#"+id).toggle();
    }
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url_commment = '{!! route('comments.store_comment') !!}';
    var url_reply_commment = '{!! route('comments.store_reply_comment') !!}';
</script>
@endsection
