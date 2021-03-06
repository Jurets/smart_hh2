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
<form method="post" action="<?php echo Url::to(['/user/cabinet'],true)?>" enctype="multipart/form-data">
    <input type="hidden" name="signature" value="Verid">
    <fieldset>
        <?php
        echo FileInput::widget([
            'language' => common\components\Commonhelper::LanguageNormalize(),
            'id' => 'popup-inputVerifycationsDocs'.Yii::$app->user->id,
            'name' => 'vercode[]',
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
            ],
        ]);
        ?>
        <?php echo Html::submitButton(Yii::t('app','Submit'), ['class'=>'btn btn-average btn-width']) ?>
    </fieldset>
</form>
