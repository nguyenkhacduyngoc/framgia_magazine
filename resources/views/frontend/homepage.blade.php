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
                    @if($posts['sliders']['main'] != null )
                        @foreach($posts['sliders']['main'] as $slider)
                            <div class="slider-content slider-main">
                                {!! Html::image(config('config.link_upload_file') . $slider->img) !!}
                                <div class="slider-layer">
                                    <p><a href="{!! route('posts.show', $slider->slug ? $slider->slug : $slider->id)!!}">{!! $slider->title !!}</a></p>
                                    <ul class="list-unstyled list-inline">
                                        <li class="list-inline-item">{!! $slider->category ==null ? null : strtoupper($slider->category->name) !!}</li>
                                        <li class="list-inline-item">{!! $slider->created_at !!}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 slider-fix">
                @if($posts['sliders']['side'] != null )
                    @foreach($posts['sliders']['side'] as $slider)
                        <div class="slider-sidebar sidebar-o">
                            {!! Html::image(config('config.link_upload_file') . '/' . $slider->img, null, ['class' => 'img-side img-fluid']) !!}
                            <div class="sidebar-layer">
                                <p>
                                    <a href="{{ route('posts.show', $slider->slug ? $slider->slug : $slider->id) }}">{!! substr($slider->title, 0, 90) !!}{!! strlen($slider->title) > 50 ? "...": "" !!}</a>
                                </p>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">{!! $slider->category ==null ? null : strtoupper($slider->category->name) !!}</li>
                                    <li class="list-inline-item">{!! $slider->created_at !!}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
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
                                            <a href="{{ route('posts.show', $posts['lastest']->slug ? $posts['lastest']->slug : $posts['lastest']->id) }}">{!! $posts['lastest']->title !!}</a>
                                        </h6>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">{!! $posts['lastest']->category == null ? null : strtoupper($posts['lastest']->category->name) !!}</li>
                                            <li class="list-inline-item">{!! $posts['lastest']->created_at !!}</li>
                                        </ul>
                                        <p>{!! substr($posts['lastest']->content, 0, 100) !!}{!! strlen($posts['lastest']->content) > 50 ? "....": "" !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @foreach($posts['lastest_paginates'] as $lastest_paginate)
                                        <div class="slider-content">
                                            <div class="slider-img">
                                                <a href="{{ route('posts.show', $lastest_paginate->slug ? $lastest_paginate->slug : $lastest_paginate->id) }}"><img src="{!! asset(config('config.link_upload_file'). '/' .$lastest_paginate->img) !!}" alt="" class="img-fluid"></a>
                                            </div>
                                            <div class="img-content">
                                                <p>
                                                    <a href="{{ route('posts.show', $lastest_paginate->slug ? $lastest_paginate->slug : $lastest_paginate->id) }}">{!! substr($lastest_paginate->title, 0, 60) !!}{!! strlen($lastest_paginate->content) > 50 ? "...": "" !!}</a>
                                                </p>
                                                <span>{!! $lastest_paginate->created_at !!}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="latest-top">
                        <h4>{!! trans('auth.categories') !!}</h4>
                    </div>
                    <div class="owl-carousel latest-slider">
                    @foreach($categories as $category)
                        @if($category->posts != null)
                        <div class="latest-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="latest-content">
                                    <?php $first_post_category = $category->posts->sortByDesc('created_at')->firstWhere('status', 2);?>
                                        <img src="{!! asset(config('config.link_upload_file'). '/' .$first_post_category['img']) !!}" alt=""
                                             class="img-fluid">
                                        <h6>
                                            <a href="{{ route('posts.show', $first_post_category['slug'] ? $first_post_category['slug'] : $first_post_category['id']) }}">{!! $first_post_category['title']!!}</a>
                                        </h6>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">{!! $first_post_category['category'] == null ? null : strtoupper($category->name) !!}</li>
                                            <li class="list-inline-item">{!! $first_post_category['created_at'] !!}</li>
                                        </ul>
                                        <p>{!! substr($first_post_category['content'], 0, 100) !!}{!! strlen($first_post_category['content']) > 50 ? "....": "" !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @foreach($category->posts->sortByDesc('created_at')->where('status', 2)->take(5)->slice(1) as $lastest_paginate)
                                        <div class="slider-content">
                                            <div class="slider-img">
                                                <a href="{{ route('posts.show', $lastest_paginate->slug ? $lastest_paginate->slug : $lastest_paginate->id) }}"><img src="{!! asset(config('config.link_upload_file'). '/' .$lastest_paginate->img) !!}" alt="" class="img-fluid"></a>
                                            </div>
                                            <div class="img-content">
                                                <p>
                                                    <a href="{{ route('posts.show', $lastest_paginate->slug ? $lastest_paginate->slug : $lastest_paginate->id) }}">{!! substr($lastest_paginate->title, 0, 60) !!}{!! strlen($lastest_paginate->content) > 50 ? "...": "" !!}</a>
                                                </p>
                                                <span>{!! $lastest_paginate->created_at !!}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
                @include('frontend.sidebar')
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
                                <a href="{{ route('posts.show', $more_new->slug ? $more_new->slug : $more_new->id) }}"><img src="{{ asset('upload/posts' . '/' . $more_new->img) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="img-content">
                                <h6>
                                    <a href="{{ route('posts.show', $more_new->slug ? $more_new->slug : $more_new->id) }}">{!! substr($more_new->title, 0, 100) !!}{!! strlen($more_new->title) > 50 ? "....": "" !!}</a>
                                </h6>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-inline-item">{!! $more_new->category ==null ? null :  $more_new->category->name !!}</li>
                                    <li class="list-inline-item">{!! $more_new->created_at !!}</li>
                                </ul>
                                <p>{!! substr($more_new->content, 0, 100) !!}{!! strlen($more_new->content) > 50 ? "....": "" !!}</p>
                            </div>
                        </div>
                    @endforeach
                    {!! $posts['more_news']->links() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End Other News -->

@endsection
