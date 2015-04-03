PPCHECK = {'lastTouch':0};

function pp_init(){
    
    PPCHECK.lastTouch =  $("#pp_group_choise option:selected").val();
    
    $('#pp_group_choise').change(function(){
        var touch = $(this).val();
        for(var i = 1; i <= 3; i++ ){
            if(i == touch){
                $('#pp_group_'+i).attr('style', 'display:block;');
               PPCHECK.lastTouch = i;
            }else{
                $('#pp_group_'+i).attr('style', 'display:none;');
            }
        }
    });
    
    $('#ClearBlockButton').click(function(){
         $("#pp_group_"+PPCHECK.lastTouch+" input:text").val('');
         return false;         
    });
}
