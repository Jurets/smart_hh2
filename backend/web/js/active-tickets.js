$(document).ready(function() {
    $('.complate-ticket').click(function() {
        var id = $(this).parent().siblings('p').find('.id-ticket').html();
        var systemKey = $(this).siblings('.input').val();

        var query = $.ajax({
            url: 'implementtask',
            data: {
                code: systemKey,
                id: id
            },
            type: 'POST'
        });

        query.done(function(data) {
            var data = jQuery.parseJSON( data );
            if (!data.result == false) {
                //TODO something
                alert(data.text);
            }else{
                //TODO something
                alert(data.text);
            }
        });

        query.fail(function(jqXHR, textStatus) {

        });

    });
});



