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
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var url_rate_post =  '{!! route('posts.rate_post') !!}'
    var all_rate = parseFloat('{!! $post->rates->count() !!}');

    $(document).ready(function() {
        for (var i = 1; i <= 5; i++) {
            var number_rate_star = parseFloat($(".bar-"+i).attr('data-id'));
            if(all_rate != 0){
                var star_per_all = ((number_rate_star/all_rate)*100).toString();
                console.log(star_per_all);
                $(".bar-"+i).width(star_per_all+'%');
            }else{
                $(".bar-"+i).width(0);
            }
        }
    });
</script>
