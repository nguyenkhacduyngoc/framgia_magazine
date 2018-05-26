// function showHide(id){
//         $("#"+id).toggle();
//     }
$(document).ready(function() {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            }
    });
    
    $(".comment").on('click', function() {
        console.log($('.comment-content').val());
        $.ajax({
            url: url_commment,
            type: 'POST',
            data: {
                 id: $('.comment').attr('id'),
                 content: $('.comment-content').val(),
            },
            success: function (result) {
                $('.comment-area').replaceWith(result)
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
            }
        });
    });
});