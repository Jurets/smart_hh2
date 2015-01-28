<?php
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