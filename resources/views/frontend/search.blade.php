@extends('frontend.master')
@section('content')
	<!-- Page Heading -->
        <section class="p-heading">
			<div class="container">
				<p> {!! trans('auth.about').' '.$posts->count().' '.trans('auth.result_for').' "'.$keyword.'" '.trans('auth.in').'('.number_format(microtime(true) - LARAVEL_START, 2, '.', '').'s)' !!} </p>
			</div>
        </section>
    <!-- End Page Heading -->

    <!-- Catagory -->
        <section class="catagory news-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                    @if($posts->count() == 0)
                        <div class="err-content text-center">
                            <h1><span></span></h1>
                            <p>{!! trans('auth.wcnf') !!}</p>
                        </div>
                    @else
                    @foreach($posts as $post)
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
                    {!! $posts->links() !!}
                    @endif
                    </div>
                    @include('frontend.sidebar')
                </div>
            </div>
        </section>
        <!-- End Catagory -->
@endsection
