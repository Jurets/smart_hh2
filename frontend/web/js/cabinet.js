$(function () {
    POPUP.init();
});

POPUP = {
    init: function () {
        $('[data-sign]').unbind('click');
        $('[data-sign]').click(function () {
            POPUP.setUpPopUp($(this).attr('data-sign'));
            POPUP.windowShow();
            return false;
        });
        POPUP.specDell();
        POPUP.diplomaDell();
        POPUP.veridDell();
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
                    return false;
                });
            }
        });
    },
    specDell: function () {
        $('[data-spec-dell]').click(function () {
            var id = $(this).attr('data-spec-dell');
            var url = $('[data-catDellUrl]').attr('data-catDellUrl');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                data: {
                    'id': id,
                },
                success: function (responce) {
                    $('.user-cabinet-content').html(responce);
                    POPUP.init();
                }
            });
           return false; 
        });
    },
    diplomaDell : function(){
      $('[data-diploma-dell]').click(function(){
          var id = $(this).attr('data-diploma-dell');
          var url = $('[data-DiplomaDell]').attr('data-DiplomaDell');
          $.ajax({
              url: url,
              type: 'POST',
              dataType: 'html',
              data: {'id':id},
              success: function(responce) {
                  $('.diploma-wrapper').html(responce);
                  POPUP.init();
              }
          });
          return false;
      });  
    },
    veridDell : function(){
      $('[data-verid-dell]').click(function(){
          var id = $(this).attr('data-verid-dell');
          var url = $('[data-VeridDell]').attr('data-VeridDell');
          $.ajax({
              url: url,
              type: 'POST',
              dataType: 'html',
              data: {'id':id},
              success: function(responce){
                  $('.verid-wrapper').html(responce);
                  POPUP.init();
              }
          });
          return false;
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
        return false;
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