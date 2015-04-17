<?php 
use yii\helpers\Html;

?>
<?php
    $data = is_null($list) ? [] : $list;
    if(!is_null($list)){
        $display = 'display:block;';
    }else{
        $display = 'display:none;';
    }
    echo Html::listBox('zip_ddl', NULL, $data, ['id'=>'zip-dropdown-id', 'size'=>4, 'style'=>$display]);
    
    
?>