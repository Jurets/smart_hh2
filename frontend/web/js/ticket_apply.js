$(function(){
    UAPPLAY.install();
});

UAPPLAY = {
    userID : null,
    
    ticketID: null,
    currentPriceBlock: null,
    
    install: function(){
        UAPPLAY.userID = $('[data-userID]').attr('data-userID');
        $('[data-apply_id]').click(function(){
            UAPPLAY.ticketID = $(this).attr('data-apply_id');
            UAPPLAY.currentPriceBlock = $('#apply-block-'+UAPPLAY.ticketID);
            UAPPLAY.currentPriceBlock.find('.popup-apply').removeClass('pop-up-hide');
            UAPPLAY.currentPriceBlock.find('.popup-apply-header').click(function(){
                $(this).parent().addClass('pop-up-hide');
            })
            if(UAPPLAY.userID === ''){
                UAPPLAY.drowAuthForm();
            }else{
                UAPPLAY.drowApplyForm();
            }
            return false;
        });
    },
    auth: function(){
        var action = $('#login-form').attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'html',
            data: $('#login-form').serialize(),
            success: function(rec){
                console.log(rec);
            },
            error: function(){
                
            }
        });
    },
    drowAuthForm: function(){
        $.ajax({
            url: $('[data-renderLoginForm]').attr('data-renderLoginForm'),
            type: 'POST',
            dataType: 'html',
            success: function(rec){
                UAPPLAY.currentPriceBlock.find('.popup-apply-content').html(rec);
                $('#ajaxLoginSubmit').click(function(){
                    UAPPLAY.auth();
                });
            },
        });
    },
    drowApplyForm: function(){
        console.log('отрисовываем форму Предложение');
    },
};