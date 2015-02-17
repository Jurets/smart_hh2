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
        
        $('#apply_button').on('click', PERFORMER.submitApply);
    },
    submitApply: function(){
        $(this).closest('form').submit();
    }
}