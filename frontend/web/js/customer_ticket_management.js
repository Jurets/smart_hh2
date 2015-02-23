$(function(){
    CUSTOMER.init();
});
CUSTOMER = {
    init: function(){
        $('.accept-offer').on('click', CUSTOMER.submitAccept);
        $('.make-another-offer').on('click', CUSTOMER.showOfferPricePopup);
        $('#popup-OfferPrice .popup-apply-header, .close').click(CUSTOMER.closePopup);
        $('#set_as_done').on('click', CUSTOMER.showSetAsDonePopup);
        $('#offer_price_form').on('submit', CUSTOMER.submitOfferPrice);
    },
    submitAccept: function(){
        $(this).closest('form').submit();
        return false;
    },
    showOfferPricePopup: function(){
        var $popup = $('#popup-OfferPrice .popup-apply');
        var performerId = $(this).attr('data-performer-id');
        $popup.find('input[name=performer_id]').val(performerId);
        $popup.find('input[name=redirect]').val('view');
        $popup.removeClass('pop-up-hide');
    },
    closePopup: function () {
        $(this).parent().addClass('pop-up-hide');
    },
    showSetAsDonePopup: function(){
        $('#set-as-done-popup').removeClass('pop-up-hide');
        return false;
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