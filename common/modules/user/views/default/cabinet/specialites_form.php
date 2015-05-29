<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
use yii\helpers\Url;
?>
<form method="post" action="<?php echo Url::to(['/user/popup_runtime'],true)?>" data-render="spec-wrapping">
   <input type="hidden" name="signature" value="Specialites">
   <fieldset>
       <?php if(!empty($dataSet)) { ?>
       <select class="" name="category_id">
            <?php foreach($dataSet as $category) { ?>
           <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
       </select>
       <?php } ?>
    <input type="button" data-submitter="" style="text-transform:uppercase;" class="btn btn-average btn-width" value="<?=Yii::t('app',"Save")?>">
   </fieldset>
</form>
