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
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url_reply_commment = '{!! route('comments.store_reply_comment') !!}';
    $(document).ready(function() {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
            });

        $(".reply-comment").on('click',function(){
            var comment_id=  $(this).attr('id');
            var slug=  $(this).attr('data-id');
            var content=  $('#reply-content-'+comment_id).val();

            $.ajax({
                url : url_reply_commment,
                type : "POST",
                data : {
                    id: comment_id,
                    slug: slug,
                    content: content,
                },
                success: function (result) {
                    $('.comment-area').replaceWith(result)
                }
            });
        });
    });
</script>
