$(function () {
    $('.pop-up-edit').addClass('pop-up-hide');
    $('[data-sign]').click(function () {
        POPUP.setUpPopUp($(this).attr('data-sign'));
        $('.pop-up-edit').removeClass('pop-up-hide');
    });
});

POPUP = {
    setUpPopUp: function (param) {
        $.ajax({
            'url': '/user/popup_render',
            'type': 'POST',
            'dataType': 'html',
            'data': {
                'signature': param
            },
            'success': function (responce) {
                $('.pop-up-wrapper').html(responce);
                $('.close').click(function () {
                    $('.pop-up-edit').addClass('pop-up-hide');
                });
            }
        });
    }
};