ProfileJobs = {
    init: function(){
        $('.tabs-container').on('click', '.btn', ProfileJobs.showMoreHandler);
        
        $('.tabs-container .user-info a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        
        $('.tabs-container a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var $newActiveTab = $(e.target);
            $newActiveTab
                    .closest('.tabs-container')
                    .find('a[data-toggle="tab"]')
                    .removeClass('positive')
                    .addClass('negative');
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


