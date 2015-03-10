<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FooterContent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="footer-content-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php //echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'title')->dropDownList($model->renderVarriants) ?>

    <?php //echo $form->field($model, 'lang')->textInput() ?>
    <?php echo $form->field($model, 'lang')->dropDownList($model->getLanguagesArray()) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'img')->textInput() ?>
    <?php echo $form->field($model, 'img')->dropDownList($model->getImagesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
