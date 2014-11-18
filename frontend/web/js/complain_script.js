$(function(){
    $('#complain_send').click(function(){
        jQuery.ajax({
            url:    $('#param1').html(),
            type:   "POST",
            dataType: "html",
            data: jQuery('#complain_sender').serialize(),
            success: function(response){
                $('#modal_complain_content').html(response);
            },
            error: function(response){
               $('#modal_complain_content').html(response);
            }
        });
    });
});