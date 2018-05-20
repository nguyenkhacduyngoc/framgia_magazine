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
                            <li class="list-inline-item"><i class="fa fa-comments"></i><a
                                        href="#">{{ trans('auth.number') }} {{ trans('auth.comments') }}</a></li>
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
                                    <li class="list-inline-item"><a href="#">{{ trans('auth.tags') }}</a></li>
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
                    <div class="news-comment">
                        <h4>{{ trans('auth.comments') }} <span>({{ trans('auth.number') }})</span></h4>
                    </div>
                    <div class="comment-reply">
                        <h4>{{ trans('auth.comments') }}</h4>
                        {!! Form::open(['route' =>'login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'ajax-contact']) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <p>{!! Form::input('text', 'name', null, ['class' => 'form-control', 'id' =>'name', 'placeholder' => 'NAME']) !!}</p>
                            </div>
                            <div class="col-lg-6">
                                <p>{!! Form::input('email', 'email', null, ['class' => 'form-control', 'id' =>'name', 'placeholder' => 'EMAIL']) !!}</p>
                            </div>
                            <div class="col-lg-12">
                                <p>{!! Form::textarea('message', null, ['id' =>'message', 'placeholder' => 'COMMENT']) !!}</p>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::button(trans('auth.create'), ['type' => 'submit']) !!}
                            </div>
                        </div>
                        <div id="form-messages"></div>
                        {!! Form::close() !!}

                    </div>
                    <div class="relate-news">
                        <h4>{{ trans('auth.related_news') }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="tab-widget">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#m-view"
                                   role="tab">{{ trans('auth.most_viewed') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#comment"
                                   role="tab">{{ trans('auth.comments') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#catagory"
                                   role="tab">{{ trans('auth.categories') }}</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="m-view" role="tabpanel">
                                <div class="m-view-content">
                                    <div class="m-view-img">
                                        <a href="#"><img src="images/latest-5.jpg" alt="" class="img-fluid"></a>
                                    </div>
                                    <div class="img-content">
                                        <p><a href="#">{{ trans('auth.home') }}</a></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="comment" role="tabpanel">
                                <div class="comment-content">
                                    <div class="comment-img">
                                        <a href="#"><i class="fa fa-user"></i></a>
                                    </div>
                                    <div class="img-content">
                                        <p><a href="#"><span>{{ trans('auth.home') }}</span>{{ trans('auth.home') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="catagory" role="tabpanel">
                                <div class="catagory-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><a href="#">{{ trans('auth.home') }}
                                                        <span>{{ trans('auth.number') }}</span></a></li>
                                                <li><a href="#">{{ trans('auth.home') }}
                                                        <span>{{ trans('auth.number') }}</span></a></li>
                                                <li><a href="#">{{ trans('auth.home') }}
                                                        <span>{{ trans('auth.number') }}</span></a></li>
                                                <li><a href="#">{{ trans('auth.home') }}
                                                        <span>{{ trans('auth.number') }}</span></a></li>
                                                <li><a href="#">{{ trans('auth.home') }}
                                                        <span>{{ trans('auth.number') }}</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tag-widget">
                        <h4>{{ trans('auth.tags') }}</h4>
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a href="#">{{ trans('auth.category') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End News Details -->
@endsection
