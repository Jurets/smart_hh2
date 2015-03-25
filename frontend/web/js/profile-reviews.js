ProfileReviews = {
  init: function(){
      $('[data-review-opinions]').on('click', '.btn', ProfileReviews.showMoreHandler);
  },
  
  showMoreHandler: function(e){
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('.reviews-holder').find('.collapse');
        $collapse.collapse('toggle');
        $this.hide();
    }  
};

$(function(){
    ProfileReviews.init();
})