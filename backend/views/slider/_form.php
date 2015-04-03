
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php //echo $form->field($model, 'picture')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->errorSummary($model); // on array? ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?php
        $fileInputFeature = [
            'id'=>'pic-slider',
            'name' => 'picture',
            'options' => [
                'multiple' => false,
            ],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
            ],
        ];
        if (!empty($model->photo)) {
            $fileInputFeature['pluginOptions']['initialPreview'] = [
                Html::img(Yii::$app->params['upload.url'] . DIRECTORY_SEPARATOR . $model->picture, ['class' => 'file-preview-image'])
            ];
        }
        
    ?>
    <?php echo FileInput::widget($fileInputFeature);?><br><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
