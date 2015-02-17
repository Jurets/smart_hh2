$(function(){
    PERFORMER.init();
});
PERFORMER = {
    direction : '',
    init : function(){
        var stage = $('[data-Stage]').attr('data-Stage');
        if(stage === ''){
            PERFORMER.direction = 'proposal';
        }else{
            PERFORMER.direction = '';
        }
    }
}