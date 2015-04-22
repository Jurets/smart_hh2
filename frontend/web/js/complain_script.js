$(function(){
    $('#complain-form').addClass('pop-up-hide');
    $('#complain-report').click(function(){
        $('#complain-form').removeClass('pop-up-hide');
        return false;
    });
    $('.close').click(function(){
        $('#complain-form').addClass('pop-up-hide');
        $('#lang-pop-up').css({display: 'none'});
        return false;
    });
    $('#complain_send').click(function(){        
        var url = $('[data-complain-url]').attr('data-complain-url');
        $.ajax({
            url:    url,
            type:   "POST",
            dataType: "html",
            data: jQuery('#complain_sender').serialize(),
            success: function(response){
                $('#complain_message').html(response);
            },
            error: function(response){
               var error = response.responseText;
               $('#complain_message').html(error.substr(18));
            }
        });
    });
});