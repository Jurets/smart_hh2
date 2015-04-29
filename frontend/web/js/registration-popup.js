$(function () {
    $('.performer-register').click(function () {
        REGWIN.actionUrl = $('[data-performer-register-first]').attr('data-performer-register-first');
        REGWIN.formLoader();
        return false;
    });
});
REGWIN = {
    actionUrl: '',
    formLoader: function () {
        $.ajax({
            'url': REGWIN.actionUrl,
            'type': 'POST',
            'dataType': 'html',
            'data': {
                'signature': 'load',
            },
            'success': function (responce) {
                $('#registerPopupWindow').html(responce);
                $('#small-popup-close').trigger('click');
                REGWIN.init();
            }
        });
    },
    formRequest: function(){
        $.ajax({
            'url': REGWIN.actionUrl,
            'type': 'POST',
            'dataType': 'html',
            'data': $('#register-form').serialize(), 
            'success': function (responce) {
                $('#registerPopupWindow').html(responce);
                $('#submit-button').click(REGWIN.formRequest);
            }
        });
    },
    init: function () {
        $('#registerPopupWindow').dialog({
            width: 'auto',
            height: 'auto',
            autoOpen: 'true',
            create: function (event, ui) {
                var widget = $(this).dialog("widget");
                $(".ui-dialog-titlebar-close span", widget).removeClass("ui-icon-closethick").removeClass("ui-icon");
            },

            close: function (event, ui) {
                $('#registerPopupWindow').html('');
                $('#registerPopupWindow').dialog('destroy');
            },
        });
        /* init submit form  - all forms must has button with id = "submit-button" */
        $('#submit-button').click(REGWIN.formRequest);
    }
};