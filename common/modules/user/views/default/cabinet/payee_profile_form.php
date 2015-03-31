<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" 
 * - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
use yii\helpers\Url;
use yii\helpers\Html;
?>
<form method="post" action="<?php echo Url::to(['/user/popup_runtime'],true)?>" data-render="user-contact">
   <input type="hidden" name="signature" value="PayeeProfile">
   <fieldset>
       <?=  Html::hiddenInput('id', $dataSet->id)?>
        <?=Html::dropDownList('choise', (!empty($dataSet->choise)) ? $dataSet->choise : '1', ['1'=>'var1', '2'=>'var2', '3'=>'var3'])?>
        <input type="button" data-submitter="" class="btn btn-average btn-width" value="SAVE">
   </fieldset>
</form>
