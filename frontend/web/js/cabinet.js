$(function () {
    POPUP.init();
});

POPUP = {
    init: function () {
        $('[data-sign]').click(function () {
            POPUP.setUpPopUp($(this).attr('data-sign'));
            POPUP.windowShow();
        });
    },
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
                POPUP.windowSubmitter();
                $('.close').click(function () {
                    POPUP.windowErase();
                });
            }
        });
    },
    windowClose: function () {
        $('.pop-up-edit').addClass('pop-up-hide');
    },
    windowErase: function () {
        $('.pop-up-wrapper').html('');
    },
    windowShow: function () {
        $('.pop-up-edit').removeClass('pop-up-hide');
    },
    windowSubmitter: function () {
        $('[data-submitter]').click(function () {
            var form = $(this).parent('fieldset').parent('form');
            POPUP.formSender(form);
        });
        $('[data-submitter]').parent('fieldset').parent('form').submit(function () {
            POPUP.formSender($(this));
            return false;
        });
    },
    formSender: function (form) {
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'html',
            data: form.serialize(),
            success: function (responce) {
                var render = form.attr('data-render');
                $('.' + render).parent().html(responce);
                POPUP.windowClose();
                POPUP.init();
                POPUP.stars_patch();
                POPUP.windowErase();
            },
            error: function (responce) {
                var error = responce.responseText;
                $('.pop-up-errors').html(error.substr(18));

            }
        });
    },
    stars_patch: function () {
        $('.person-profile').find('link').attr('href', '');
    }
};