function showHide(id){
    $("#"+id).toggle();
}

function ConfirmDelete()
{
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
       return false;
}

$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            }
    });

    for (var i = 1; i <= 5; i++) {
        var number_rate_star = parseFloat($(".bar-"+i).attr('data-id'));
        if(all_rate != 0){
            var star_per_all = ((number_rate_star/all_rate)*100).toString();
            $(".bar-"+i).width(star_per_all+'%');
        }else{
            $(".bar-"+i).width(0);
        }
    }
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
        });
        
    if($('.like-button').hasClass('fa-thumbs-up')){
        $('.liked-post').html('You and '+post_liked+'people liked this post');
    }
    if($('.like-button').hasClass('fa-thumbs-o-up')){
        $('.liked-post').html('Have '+post_liked+'people liked this post');
    }

    $(".like-button").on('click',function(){
        $.ajax({
            url : url_like_post,
            type : "POST",
            data : {
                slug: slug,
            },
            success: function (result) {
                if(result == "" ){
                    $('.like-button').addClass('fa-thumbs-o-up').removeClass('fa-thumbs-up').html('Like');
                }else{
                    $('.like-button').addClass('fa-thumbs-up').removeClass('fa-thumbs-o-up').html('Liked');
                }
                if($('.like-button').hasClass('fa-thumbs-up')){
                    $('.liked-post').html('You and '+post_liked+'people liked this post');
                }
                if($('.like-button').hasClass('fa-thumbs-o-up')){
                    $('.liked-post').html('Have '+post_liked+'people liked this post');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status == 401)
                {
                    alert('Need login to do this');
                }

            }
        });
    });
    
    $(".comment").on('click', function() {
        $.ajax({
            url: url_commment,
            type: 'POST',
            data: {
                 id: $('.comment').attr('id'),
                 content: $('.comment-content').val(),
            },
            success: function (result) {
                $('.comment-area').replaceWith(result)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status == 401)
                {
                    alert('Need login to do this');
                }
            }
        });
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
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status == 401)
                {
                    alert('Need login to do this');
                }
            }
        });
    });

    $(".rating-star").on('click',function(){
        var star_rate =  parseFloat($(this).attr('id').replace("star-", ""));
        var r = confirm("Star rate: " + star_rate);
        if(r == true){
            $.ajax({
                url : url_rate_post,
                type : "POST",
                data : {
                    slug: slug,
                    star_rate: star_rate,
                },
                success: function (result) {
                    $(".rating-area").replaceWith(result);
                    $(".rating-star").each(function(){
                        if($(this).attr('id').replace("star-", "") <= star_rate){
                            $(this).addClass('checked');
                        }
                        if($(this).attr('id').replace("star-", "") > star_rate){
                            $(this).removeClass('checked');
                        }
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status == 401)
                    {
                        alert('Need login to do this');
                    }
                }
            });
        }
    });
});