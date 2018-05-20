@extends('frontend.master')
@section('content')

    <!-- Web Ticker -->
    <section class="top-news">
        <div class="container">
            <div class="news-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ticker d-flex justify-content-between">
                            <div class="news-head">
                                <span>{{ trans('auth.breaking_news') }}<i class="fa fa-caret-right"></i></span>
                            </div>
                            <ul id="webTicker">
                                @foreach($posts['sliders']['main'] as $slider)
                                    <li><a href="#"><i class="fa fa-dot-circle-o"></i>{!! $slider->title !!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Web Ticker -->

    <!-- Slider Area -->
    <section class="slider-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 padding-fix-r">
                    <div class="owl-carousel owl-slider">
                        @foreach($posts['sliders']['main'] as $slider)
                            <div class="slider-content">
                                {!! Html::image(config('config.link_upload_file') . '/' . $slider->img) !!}
                                <div class="slider-layer">
                                    <p><a href="{{ route('posts.show', $slider->id) }}">{!! $slider->title !!}</a></p>
                                    <ul class="list-unstyled list-inline">
                                        <li class="list-inline-item">{!! strtoupper($slider->category->name) !!}</li>
                                        <li class="list-inline-item">{!! $slider->created_at !!}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 slider-fix">
                    @foreach($posts['sliders']['side'] as $slider)
                        <div class="slider-sidebar sidebar-o">
                            {!! Html::image(config('config.link_upload_file') . '/' . $slider->img, null, ['class' => 'img-fluid']) !!}
                            <div class="sidebar-layer">
                                <p>
                                    <a href="{{ route('posts.show', $slider->id) }}">{!! substr($slider->title, 0, 90) !!}{!! strlen($slider->title) > 50 ? "...": "" !!}</a>
                                </p>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">{!! strtoupper($slider->category->name) !!}</li>
                                    <li class="list-inline-item">{!! $slider->created_at !!}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider Area -->

    <!-- All News -->
    <section class="allnews news-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="latest-top">
                        <h4>{!! trans('auth.lastest_news') !!}</h4>
                    </div>
                    <div class="owl-carousel latest-slider">
                        <div class="latest-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="latest-content">
                                        <img src="{!! asset(config('config.link_upload_file'). '/' .$posts['lastest']->img) !!}" alt=""
                                             class="img-fluid">
                                        <h6>
                                            <a href="{{ route('posts.show', $posts['lastest']->id) }}">{!! $posts['lastest']->title !!}</a>
                                        </h6>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">{!! strtoupper($posts['lastest']->category->name) !!}</li>
                                            <li class="list-inline-item">{!! $posts['lastest']->updated_at !!}</li>
                                        </ul>
                                        <p>{!! substr($posts['lastest']->content, 0, 100) !!}{!! strlen($posts['lastest']->content) > 50 ? "....": "" !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @foreach($posts['lastest_paginates'] as $lastest_paginate)
                                        <div class="slider-content">
                                            <div class="slider-img">
                                                <a href="{{ route('posts.show', $lastest_paginate->id) }}"><img src="{!! asset(config('config.link_upload_file'). '/' .$lastest_paginate->img) !!}" alt="" class="img-fluid"></a>
                                            </div>
                                            <div class="img-content">
                                                <p>
                                                    <a href="{{ route('posts.show', $lastest_paginate->id) }}">{!! substr($lastest_paginate->title, 0, 60) !!}{!! strlen($lastest_paginate->content) > 50 ? "...": "" !!}</a>
                                                </p>
                                                <span>{!! $lastest_paginate->updated_at !!}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="text-center">
                                        {!! $posts['lastest_paginates']->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <!-- End All News -->

    <!-- Other News -->
    <section class="oth-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="more-top">
                        <h4>{!! trans('auth.more_news') !!}</h4>
                    </div>
                    @foreach($posts['more_news'] as $more_new)
                        <div class="more-content">
                            <div class="more-img">
                                <a href="{{ route('posts.show', $more_new->id) }}"><img src="{{ asset('upload/posts' . '/' . $more_new->img) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="img-content">
                                <h6>
                                    <a href="{{ route('posts.show', $more_new->id) }}">{!! substr($more_new->title, 0, 100) !!}{!! strlen($more_new->title) > 50 ? "....": "" !!}</a>
                                </h6>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">{!! $more_new->category->name !!}</li>
                                    <li class="list-inline-item">{!! $more_new->updated_at !!}</li>
                                </ul>
                                <p>{!! substr($more_new->content, 0, 100) !!}{!! strlen($more_new->content) > 50 ? "....": "" !!}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        {!! $posts['more_news']->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Other News -->

@endsection
