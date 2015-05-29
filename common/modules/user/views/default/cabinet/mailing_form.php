<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
use yii\helpers\Url;
?>
<form method="post" action="<?php echo Url::to(['/user/popup_runtime'],true)?>" data-render="user-contact">
   <input type="hidden" name="signature" value="AdressMailing">
   <fieldset>
       <input type="text" name="adress_mailing" value="<?=$dataSet?>" style="margin-bottom: 15px;">
    <input style="text-transform:uppercase;" type="button" data-submitter="" class="btn btn-average btn-width" value="<?=Yii::t('app', "Save")?>">
   </fieldset>
</form>
