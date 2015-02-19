$(function(){
    CUSTOMER.init();
});
CUSTOMER = {
    init : function(){
        $('.accept-offer').on('click', CUSTOMER.submitAccept);
//        $('#offer_button').on('click', PERFORMER.showOfferPricePopup);
//        $('#popup-OfferPrice .popup-apply-header, #set-as-done-popup .close').click(PERFORMER.closePopup);
    },
    submitAccept: function(){
        $(this).closest('form').submit();
        return false;
    },
    showOfferPricePopup: function(){
        $('#popup-OfferPrice .popup-apply').removeClass('pop-up-hide');
    },
    closePopup: function () {
                $(this).parent().addClass('pop-up-hide');
    }
};