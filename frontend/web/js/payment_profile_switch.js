function pp_init(){
    $('#pp_group_choise').change(function(){
        var touch = $(this).val();
        for(var i = 1; i <= 3; i++ ){
            if(i == touch){
                $('#pp_group_'+i).attr('style', 'display:block;');
            }else{
                $('#pp_group_'+i).attr('style', 'display:none;');
            }
        }
    });
}
