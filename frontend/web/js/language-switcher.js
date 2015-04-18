var switchlocker;

$(function(){
   switchlocker = 0;
   $('#language').ddslick('destroy');
   $('#language').ddslick({
       onSelected: function (data) {
           switchLanguage(data);
       },
    
   });
})

function switchLanguage(data){
    if(switchlocker == 0){
        switchlocker = 1;
        return 0;
    }
    var lang = data.selectedData.value;
    var Url = $('[data-langUrlChange]').attr('data-langUrlChange');
    $.ajax({
            'url' : Url,
            'type' : 'POST',
            'dataType' : 'html',
            'data' : {
                'language' : lang,
            },
            'success' : function(responce){
               location.reload();
            } 
        });
}