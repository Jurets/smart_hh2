ProfileJobs = {
    init: function(){
        $('.created-jobs-container').on('click', '.btn', ProfileJobs.showMoreHandler);
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


