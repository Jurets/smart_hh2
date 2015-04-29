$(function(){
    $('#test-modal-1').dialog();
    $("#test-modal-1").dialog({
        
        width: 'auto',
    height: 'auto', 
        
        autoOpen: true,
        title: $('[data-modal-popup-title]').attr('data-modal-popup-title'),
    });
});