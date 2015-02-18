OfferJob = {
    init: function(){
        $('.user-holder').on('click', '.offer-job-button', OfferJob.loadOfferJobPopup);
        $('#offer-job-pop-up-container').on('click', '.close', OfferJob.closePopup)
    },
    loadOfferJobPopup: function(){
        $button = $(this);
        userId = $button.attr('data-user-id');
        url = $button.attr('data-url');
        $('#offer-job-pop-up-container').load(url, {user_id: userId});
        return false;
    },
    closePopup: function(){
        $('#offer-job-pop-up-container .pop-up').addClass('pop-up-hide');
        return false;
    }
};

$(function () {
    OfferJob.init();
});


