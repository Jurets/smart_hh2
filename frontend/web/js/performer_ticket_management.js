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
        
        $('#apply_button,#accept_offer_button').on('click', PERFORMER.submitApply);
        $('#offer_button').on('click', PERFORMER.showOfferPricePopup);
       // $('#set_as_done').on('click', PERFORMER.setAsDone);
        $('#set_as_done').on('click', PERFORMER.showSetAsDonePopup);
        $('#popup-OfferPrice .popup-apply-header, #set-as-done-popup .close').click(PERFORMER.closePopup);
        $('#offer_price_form').on('submit', PERFORMER.submitOfferPrice);
    },
    submitApply: function(){
        if($(this).attr('data-need-price') === '1'){
            PERFORMER.showOfferPricePopup();
            return false;
        }
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
    },
    setAsDone: function(){
        if($(this).attr('data-is-own-ticket') == '1'){
            PERFORMER.showSetAsDonePopup();
            return false;
        }
        $(this).closest('form').submit();
    },
    submitOfferPrice: function(e){
        var price = $(this).find('input[name=price]').val();
        if(price > 0){
            $('#popup-OfferPrice .offer-price-greater-zero').hide();
            return;
        }
        $('#popup-OfferPrice .offer-price-greater-zero').show();
        e.preventDefault();
    }
};