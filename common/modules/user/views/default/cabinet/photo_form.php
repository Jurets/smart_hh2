<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;
/*@var $this yii\web\View*/
?>
<form method="post" action="/user/cabinet" enctype="multipart/form-data" data-render="user-item">
    <input type="hidden" name="signature" value="PhotoUploads">
    <fieldset>
        <?php
        echo FileInput::widget([
            'id' => 'popup-inputFile',
            'name' => 'photo',
            'options' => [
                'multiple' => false,
            ],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
            ],
        ]);
        ?>
        <!--<input type="submit" class="btn btn-average btn-width" value="SAVE">-->
        <?php echo Html::submitButton('Submit', ['class'=>'btn btn-average btn-width']) ?>
    </fieldset>
</form>
