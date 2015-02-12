ProfileJobs = {
    init: function(){
        $('.created-jobs-container').on('click', '.btn', ProfileJobs.showMoreHandler);
        
        $('.created-jobs-container .user-info a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        
        $('.created-jobs-container a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $newActiveTab = $(e.target);
            $('.created-jobs-container a[data-toggle="tab"]').removeClass('positive').addClass('negative');
            $newActiveTab.removeClass('negative').addClass('positive');
        });
    },
    showMoreHandler: function(e){
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.reviews-holder').find('.collapse');
        $collapse.collapse('toggle');
        $this.hide();
    }
};

$(function () {
    ProfileJobs.init();
});


