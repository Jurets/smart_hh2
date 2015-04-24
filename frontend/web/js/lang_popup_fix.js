$(function(){
    $('.close').click(function(){
        $('.lang-pop-up').css({display: 'none'});
        return false;
    });
    $('.open-lang').click(function(){
        $('.lang-pop-up').css({display: 'inline'});
        return false;
    });
});