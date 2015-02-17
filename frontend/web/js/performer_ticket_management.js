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
        $('#set_as_done').on('click', PERFORMER.showSetAsDonePopup);
        $('#popup-OfferPrice .popup-apply-header, #set-as-done-popup .close').click(PERFORMER.closePopup);
    },
    submitApply: function(){
        $(this).closest('form').submit();
    },
    showOfferPricePopup: function(){
        $('#popup-OfferPrice .popup-apply').removeClass('pop-up-hide');
    },
    showSetAsDonePopup: function(){
        $('#set-as-done-popup').removeClass('pop-up-hide');
    },
    closePopup: function () {
                $(this).parent().addClass('pop-up-hide');
    }
};