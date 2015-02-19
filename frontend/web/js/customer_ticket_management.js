$(function(){
    CUSTOMER.init();
});
CUSTOMER = {
    init: function(){
        $('.accept-offer').on('click', CUSTOMER.submitAccept);
        $('.make-another-offer').on('click', CUSTOMER.showOfferPricePopup);
        $('#popup-OfferPrice .popup-apply-header').click(CUSTOMER.closePopup);
    },
    submitAccept: function(){
        $(this).closest('form').submit();
        return false;
    },
    showOfferPricePopup: function(){
        $popup = $('#popup-OfferPrice .popup-apply');
        performerId = $(this).attr('data-performer-id');
        $popup.find('input[name=performer_id]').val(performerId);
        $popup.find('input[name=redirect]').val('view');
        $popup.removeClass('pop-up-hide');
    },
    closePopup: function () {
        $(this).parent().addClass('pop-up-hide');
    }
};