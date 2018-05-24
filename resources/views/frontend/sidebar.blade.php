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
                <div class="m-view-content catagory-content">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-unstyled">
                            @foreach($mostviewed_posts as $mostviewed_post)
                                <li><a href="{!! route('posts.show', $mostviewed_post->slug ? $mostviewed_post->slug : $mostviewed_post->id) !!}">{!! substr($mostviewed_post->title, 0, 40) !!}{!! strlen($mostviewed_post->title) > 40 ? "...": "" !!}
                                        <span>{!! $mostviewed_post->count_viewed !!}</span>
                                </li>
                            @endforeach
                            </ul>
                        </div>
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
                        <div class="col-md-12">
                            <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li><a href="{!! route('category', $category->id ) !!}">{!! $category->name !!}
                                        <span>{!! $category->posts()->count() !!}</span>
                                    </a>
                                </li>
                            @endforeach
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
        @foreach($tags as $tag)
            <li class="list-inline-item"><a href="{!! route('tag', $tag->id ) !!}">#{{ $tag->content }}</a></li>
        @endforeach
        </ul>
    </div>
</div>
