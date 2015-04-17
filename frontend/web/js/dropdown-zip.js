$(function(){
    ZIPI.init();
    $('#zip-dropdown-id').trigger('click');
});

ZIPI = {
    
    init : function(){
      $('#zip_tf_id').on('input', ZIPI.dropdownchange);
    },
    
    dropdownchange : function(){
        var url = $('[data-zipDropdownURL]').attr('data-zipDropdownURL');
        $('#zip_id').val('');
        $.ajax({
            'url' : url,
            'type' : 'POST',
            'dataType' : 'html',
            'data' : {
                'zip_tf' : $('#zip_tf_id').val(),
            },
            'success' : function(responce){
                $('#zip-dropdown-id').parent().html(responce);
                $('#zip-dropdown-id').on('change',ZIPI.writeZipTextField);
            } 
        });
    },
    
    writeZipTextField : function(){
        var id = $(this).val();
        var text = $('#zip-dropdown-id option:selected').text();
        var textFilter = text.split(' - ')[0];
        $('#zip_tf_id').val(textFilter);
        $('#zip_id').val(id);
    }
    
};