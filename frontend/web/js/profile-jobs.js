ProfileJobs = {
    init: function(){
        $('.created-jobs-container .btn').on('click', ProfileJobs.showMoreHandler);
    },
    showMoreHandler: function(e){
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.created-jobs-container').find('.collapse');
        $collapse.collapse('toggle');
        $this.hide();
    }
};

$(function () {
    ProfileJobs.init();
});


