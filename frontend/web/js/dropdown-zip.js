$(function () {
    ZIPI.init();
    $('#zip-dropdown-id').trigger('click');
});

ZIPI = {
    url: '',
    init: function () {
        $('#zip_tf_id').on('input', ZIPI.dropdownchange);
        ZIPI.url = $('[data-zipDropdownURL]').attr('data-zipDropdownURL');
    },
    dropdownchange: function () {
        var fieldContent = $('#zip_tf_id').val();
        var regChecked = /^[^0-9]{3,}/;
        var regResult = regChecked.test(fieldContent);
        if (regResult) {
            $('#zip_id').val('');
            $.ajax({
                'url': ZIPI.url,
                'type': 'POST',
                'dataType': 'html',
                'data': {
                    'zip_tf': fieldContent,
                },
                'success': function (responce) {
                    $('#zip-dropdown-id').parent().html(responce);
                    $('#zip-dropdown-id').on('change', ZIPI.writeZipTextField);
                }
            });
        } else {
            $('#zip-dropdown-id').parent().html('<select id="zip-dropdown-id" name="zip_ddl" size="4" style="display:none;"></select>');
        }
        ZIPI.checkZipDigital(fieldContent);
    },
    writeZipTextField: function () {
        var id = $(this).val();
        var text = $('#zip-dropdown-id option:selected').text();
        var textFilter = text.split(' - ')[0];
        $('#zip_tf_id').val(textFilter);
        $('#zip_id').val(id);
    },
    checkZipDigital: function (fieldContent) {
        var checkFormat = /^[0-9][0-9][0-9][0-9][0-9]$/;
        var result = checkFormat.test(fieldContent);
        if (result) {
          $.ajax({
              'url': ZIPI.url,
              'type': 'POST',
              'dataType': 'json',
              'data': {
                'is_out_range': true,
                'zip_check' : $('#zip_tf_id').val()
              },
              'success': function(responce){
                  if(!responce.zipExist){
                      var outOfRangeMessage = $('[data-outofrangemessage]').attr('data-outofrangemessage');
                      $('#range-message').html(outOfRangeMessage);
                  }
              }
          });  
        } else {
            $('#range-message').html('');
        }
        
        
        
        //var outOgRangeMessage = $('[data-outofrangemessage]').attr('data-outofrangemessage');
    }
};