$(function () {
    UAPPLAY.install();
});

UAPPLAY = {
    userID: null,
    ticketID: null,
    currentPriceBlock: null,
    install: function () {
        $('[data-apply_id]').click(function () {
            $('.popup-apply').addClass('pop-up-hide');
            UAPPLAY.ticketID = $(this).attr('data-apply_id');
            UAPPLAY.currentPriceBlock = $('#apply-block-' + UAPPLAY.ticketID);
            UAPPLAY.currentPriceBlock.find('.popup-apply').removeClass('pop-up-hide');
            UAPPLAY.currentPriceBlock.find('.popup-apply-header').click(function () {
                $(this).parent().addClass('pop-up-hide');
            })
            UAPPLAY.userID = $('[data-userID]').attr('data-userID');
            if (UAPPLAY.userID === '') {
                UAPPLAY.drowAuthForm();
            } else {
                UAPPLAY.drowApplyForm();
            }
            return false;
        });
    },
    flush: function () {
        $('.popup-apply-content').html('<!---->');
    },
    auth: function () {
        var action = $('#login-form').attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'html',
            data: $('#login-form').serialize(),
            success: function (rec) {
                var responce = $.parseJSON(rec);
                if (responce.err !== undefined) {
                    UAPPLAY.currentPriceBlock.find('.ajax-login-form-errors').html(responce.err);
                } else {
                    $('[data-userID]').attr('data-userID', responce.usr);
                    UAPPLAY.currentPriceBlock.find('.popup-apply').addClass('pop-up-hide');
                    $('#header_refresh').html(responce.head);
                    
                    $('#language').ddslick({
                        onSelected: function (selectedData) {

                            $('#demoDefaultSelection').ddslick({
                                data: ddData,
                                defaultSelectedIndex: 1
                            });
                        }
                    });
                    
                    UAPPLAY.flush();
                }
            },
            error: function () {
                UAPPLAY.currentPriceBlock.find('.ajax-login-form-errors').html('Connection failure');
            }
        });
    },
    apply: function () {
        alert('test apply mech');
    },
    drowAuthForm: function () {
        $.ajax({
            url: $('[data-renderLoginForm]').attr('data-renderLoginForm'),
            type: 'POST',
            dataType: 'html',
            success: function (rec) {
                UAPPLAY.currentPriceBlock.find('.popup-apply-content').html(rec);
                $('#ajaxLoginSubmit').click(function () {
                    UAPPLAY.auth();
                });
            },
        });
    },
    drowApplyForm: function () {
        $.ajax({
            url: $('[data-renderApplyForm]').attr('data-renderApplyForm'),
            type: 'POST',
            dataType: 'html',
            data: {
                'ticket_id' : UAPPLAY.ticketID,
                'price' : UAPPLAY.currentPriceBlock.find('#digital_price_part').html(),
                'render' : '',
            },
            success: function (rec) {
                UAPPLAY.currentPriceBlock.find('.popup-apply-content').html(rec);
                $('#ajaxApplySubmit').click(function(){
                    
                });
            },
        })
    },
};