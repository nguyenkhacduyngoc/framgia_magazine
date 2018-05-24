@extends('frontend.master')
@section('add-css')
    {!! Html::style('css/backend/bootstrap-theme.css') !!}
    <!--external css-->
    <!-- font icon -->
    {!! Html::style('css/backend/elegant-icons-style.css') !!}
    <!-- Custom styles -->
    {!! Html::style('css/backend/style.css') !!}
    {!! Html::style('css/backend/style-responsive.css') !!}
@endsection
@section('content')
    <!--main content start-->
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
                </div>
            </div>
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4>{!! $user->fullname !!}</h4>
                                <div class="follow-ava">
                                    {!! Html::image(config('config.link_avatar').'/'.$user->avatar) !!}
                                </div>
                                <h6>{!! trans('auth.administrator') !!}</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p> {!! '@'.$user->username !!}</p>
                                <h6>
                                    <span><i class=""></i>{!! trans('auth.join_at') !!} : </span>
                                    <span><i class=""></i>{!! $user->created_at !!}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#profile">
                                        <i class="icon-user"></i>
                                        {!! trans('auth.profile') !!}
                                    </a>
                                </li>
                                @if(Auth::user()->id == $user->id)
                                    <a href="{!! route('user.edit', $user->id) !!}" class="btn btn-success float-left">{!! trans('auth.update_profile') !!}</a>
                                @endif
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- profile -->
                                <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.fullname') !!} </span>: {!! $user->fullname !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.email') !!} </span>:{!! $user->email !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.address') !!} </span>: {!! $user->address !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p>
                                                        <span>{!! trans('auth.birthday') !!}</span>: {!! $user->birthday !!}
                                                    </p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.job') !!} </span>: {!! $user->job !!}</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>{!! trans('auth.gender') !!} </span>: {!! $user->gender !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </div>
    </section>
    <section class="catagory news-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                @if($user->posts->count() == 0)
                    <div class="err-content text-center">
                        <h1><span></span></h1>
                        <p>{!! trans('auth.wcnf') !!}</p>
                    </div>
                @else
                @foreach($user->posts as $post)
                    <div class="catagory-content catagory-content-view">
                        <div class="cat-img">
                            <a href="{!! route('posts.show', $post->slug ? $post->slug : $post->id) !!}">
                                {!! Html::image(config('config.link_upload_file') . $post->img, null, ['class' => 'img-fluid img-post-category' ]) !!}
                            </a>
                        </div>
                        <div class="img-content">
                            <h6><a href=" {!! route('posts.show', $post->slug ? $post->slug : $post->id) !!} ">{!! substr($post->title, 0, 200) !!}{!! strlen($post->title) > 200 ? "...": "" !!}</a></h6>
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item">{!! $post->category->name !!}</li>
                                <li class="list-inline-item">{!! $post->created_at !!}</li>
                            </ul>
                            <p>{!! substr($post->content, 0, 210) !!}{!! strlen($post->content) > 210 ? "...": "" !!}</p>
                        </div>
                    </div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('add-js')
    {!! HTML::script('js/backend/jquery.scrollTo.min.js') !!}
    {!! HTML::script('js/backend/jquery.nicescroll.js') !!}
    {!! HTML::script('js/backend/scripts.js') !!}
    {!! HTML::script('js/backend/jquery.knob.js') !!}
    <script>
        //knob
        $(".knob").knob();
    </script>
@endsection
