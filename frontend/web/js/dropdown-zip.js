$(function () {
    ZIPI.init();
    $('#zip-dropdown-id').trigger('click');
});

ZIPI = {
    init: function () {
        $('#zip_tf_id').on('input', ZIPI.dropdownchange);
    },
    dropdownchange: function () {
        var fieldContent = $('#zip_tf_id').val();
        var regChecked = /^[^0-9]{3,}/;
        var regResult = regChecked.test(fieldContent);
        if (regResult) {
            var url = $('[data-zipDropdownURL]').attr('data-zipDropdownURL');
            $('#zip_id').val('');
            $.ajax({
                'url': url,
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
            var int1_Begin = 33000;
            var int1_End = 33499;
            var int2_Begin = 34900;
            var int2_End = 34999;
            var checkerCount = 0;
            if(fieldContent < int1_Begin || fieldContent > int1_End){ // diap 1
                checkerCount ++;
            }
            if(fieldContent <= int2_Begin || fieldContent >= int2_End){ // diap 2
                checkerCount ++;
            }
            // finalise check process
            if(checkerCount >= 2){
                alert('Diapasone out of range');
            }
        }
    },
};