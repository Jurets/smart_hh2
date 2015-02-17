$(function(){
    PERFORMER.init();
});
PERFORMER = {
    direction : '',
    init : function(){
        var stage = $('[data-Stage]').attr('data-Stage');
        if(stage === ''){
            PERFORMER.direction = 'proposal';
        }else{
            PERFORMER.direction = '';
        }
        
        $('#apply_button').on('click', PERFORMER.submitApply);
        $('#offer_button').on('click', PERFORMER.showOfferPricePopup);
        $('#popup-OfferPrice .popup-apply-header').click(PERFORMER.closePopup);
    },
    submitApply: function(){
        $(this).closest('form').submit();
    },
    showOfferPricePopup: function(){
        $('#popup-OfferPrice .popup-apply').removeClass('pop-up-hide');
    },
    closePopup: function () {
                $(this).parent().addClass('pop-up-hide');
    }
};