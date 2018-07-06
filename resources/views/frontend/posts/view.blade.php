@extends('frontend.master')
@section('add-css')
    {!! Html::style('css/frontend/rate.css') !!}
@endsection
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
                        <h5>{!! $post->subtitle !!}</h5>
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
                    @auth
                    <div class="like">
                        @if(isset($like))
                        <span><i class="fa fa-thumbs-up like-button">Liked</i></span>
                        @else
                        <span><i class="fa fa-thumbs-o-up like-button">Like</i></span>
                        @endif
                    </div>
                    <div>
                        <span><i class="fa fa-thumbs-up liked-post"><p class="text"></p></i></span>
                    </div>
                    <div class="">
                        @if(isset($user_rate))
                            <span class="heading">User Rating</span>
                            @for($i = 1; $i <= $user_rate->rate;$i++)
                            <span id="star-{!! $i !!}" class="fa fa-star rating-star checked"></span>
                            @endfor
                            @for($i = $user_rate->rate +1 ; $i <=5; $i++)
                            <span id="star-{!! $i !!}" class="fa fa-star rating-star"></span>
                            @endfor
                        @else
                            <span class="heading">Make rate for this post</span>
                            <span id="star-1" class="fa fa-star rating-star"></span>
                            <span id="star-2" class="fa fa-star rating-star"></span>
                            <span id="star-3" class="fa fa-star rating-star"></span>
                            <span id="star-4" class="fa fa-star rating-star"></span>
                            <span id="star-5" class="fa fa-star rating-star"></span>
                        @endif
                    </div>
                    @endauth
                    <div class="rating-area">
                        <p>{!! empty($post->rates->avg('rate')) ? 0 : round($post->rates->avg('rate'),2) !!} average based on {!! $post->rates->count() !!} reviews.</p>
                        <hr style="border:3px solid #f1f1f1">
                        <div class="row">
                        @for($i =5 ; $i>0; $i--)
                            <div class="side">
                                <div>{!! $i !!} star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-{!! $i !!}" data-id="{!! $post->rates->where('rate', $i)->count() !!}"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>{!! $post->rates->where('rate', $i)->count() !!}</div>
                            </div>
                        @endfor
                        </div>
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
    // function showHide(id){
    //     $("#"+id).toggle();
    // }
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url_commment = '{!! route('comments.store_comment') !!}';
    var url_reply_commment = '{!! route('comments.store_reply_comment') !!}';
    var url_rate_post =  '{!! route('posts.rate_post') !!}'
    var url_like_post =  '{!! route('posts.like_post') !!}'
    var all_rate = parseFloat('{!! $post->rates->count() !!}');
    var slug = "{!! $post->slug !!}";
    var post_liked = "{!! $post->likes->count() !!}"

</script>
@endsection
