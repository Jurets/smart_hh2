$(function () {
    var check = REGWIN.checkRegistrationStageLast();
    if(check != false){
        var mode = check.regMode;
        var urlParam = 'data-'+mode+'-register-last';
        var titleParam = 'data-title-'+mode+'-last';
        REGWIN.userId = check.regUser;
        REGWIN.actionUrl = $('['+urlParam+']').attr(urlParam);
        REGWIN.windowTitle = $('['+titleParam+']').attr(titleParam);
        REGWIN.formLoader();
    }else{
        $('.performer-register').click(function () {
            REGWIN.actionUrl = $('[data-performer-register-first]').attr('data-performer-register-first');
            REGWIN.windowTitle = $('[data-title-performer-first]').attr('data-title-performer-first');
            REGWIN.formLoader();
            return false;
        });
    }
});
REGWIN = {
    actionUrl: '',
    windowTitle: '',
    userId: '',
    formLoader: function () {
        $.ajax({
            'url': REGWIN.actionUrl,
            'type': 'POST',
            'dataType': 'html',
            'data': {
                'signature': REGWIN.userId,
            },
            'success': function (responce) {
                $('#registerPopupWindow').html(responce);
                $('#small-popup-close').trigger('click');
                REGWIN.init();
            }
        });
    },
    formRequest: function () {
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
            title: REGWIN.windowTitle,
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
    },
    checkRegistrationStageLast: function () {
        var regMode = $('[data-regmode]').attr('data-regmode');
        var regUser = $('[data-reguser]').attr('data-reguser');
        if(regMode === undefined || regUser === undefined){
            return false;
        }
        if(regMode.length == 0 && regUser.length == 0){
            return false;
        }else{
            return {
                regMode: regMode,
                regUser: regUser,
            };
        }
    },
};