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
//        $('.performer-register').click(function () {
//            REGWIN.actionUrl = $('[data-performer-register-first]').attr('data-performer-register-first');
//            REGWIN.windowTitle = $('[data-title-performer-first]').attr('data-title-performer-first');
//            REGWIN.formLoader();
//            return false;
//        });
//        $('.customer-register').click(function () {
//            REGWIN.actionUrl = $('[data-customer-register-first]').attr('data-customer-register-first');
//            REGWIN.windowTitle = $('[data-title-customer-first]').attr('data-title-customer-first');
//            REGWIN.formLoader();
//            return false;
//        });
        $('.joinNow').click(function(){
            REGWIN.actionUrl = $('[data-user-register-first]').attr('data-user-register-first');
            REGWIN.windowTitle = $('[data-title-user-first]').attr('data-title-user-first');
            REGWIN.formLoader();
            return false;
        });
    }
});
REGWIN = {
    actionUrl: '',
    windowTitle: '',
    userId: '',
    performerChecked: false, // for role choise after "sign up now"
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
                $('#small-popup-close').trigger('click'); // old
                REGWIN.init();
                if(REGWIN.performerChecked == true){
                  $('#user-role-performer').attr('checked', '1');
                }
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
                $('#registerPopupWindow').dialog('destroy').html('');
                $('#registerPopupWindow').html(responce);
                $('#submit-button').click(REGWIN.formRequest);
                REGWIN.reRender();
            }
        });
    },
    reRender: function() {
              $('#registerPopupWindow').dialog({
                  title: REGWIN.windowTitle,
                  width: 'auto',
                  height: 'auto',
                  autoOpen: 'true',
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
                //$(".ui-dialog-titlebar-close span", widget).removeClass("ui-icon-closethick").removeClass("ui-icon");
            },
            close: function (event, ui) {
                $('#registerPopupWindow').dialog('destroy');
                $('#registerPopupWindow').html('');
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
    signUpNowChoise: function(role) {
        if(role == 2){
            REGWIN.performerChecked = true;
        }
        if(role == 1){
            REGWIN.performerChecked = false;
        }
        REGWIN.actionUrl = $('[data-user-register-first]').attr('data-user-register-first');
            REGWIN.windowTitle = $('[data-title-user-first]').attr('data-title-user-first');
            REGWIN.formLoader();
            return false;
    },
};
