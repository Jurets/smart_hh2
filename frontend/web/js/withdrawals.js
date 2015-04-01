$(function(){
    $('#withdrawals').click(function(){
        $('.withdrawal-popup').show();
        return false;
    });
    $('.wd-close').click(function(){
        $('.withdrawal-popup').hide();
        $('.wd-message').html('');
        $('.wd-error').html('');
        return false;
    });
    $('#withdrawals_form').submit(function(){
        $.ajax({
            url: $('#withdrawals_form').attr('action'),
            type: 'POST',
            dataType: 'html',
            data: $('#withdrawals_form').serialize(),
            success: function (responce) {
                $('.wd-message').html(responce);
            },
            error: function (responce) {
                var error = responce.responseText;
                $('.wd-error').html(error.substr(18));
            }
        });
        return false;
    });
    
});