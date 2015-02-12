HeaderLogin = {
    init: function(){
        $('#header_refresh').on('click', '#clear-comments-btn', HeaderLogin.clearNewComments);
    },
    clearNewComments: function(){
        $btn = $(this);
        $('#new-comments-container').load($btn.attr('data-url'));
    }
};

$(function () {
    HeaderLogin.init();
});


