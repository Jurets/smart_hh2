<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'id_category')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php //echo $form->field($model, 'created')->textInput() ?>
    
    <?= $form->field($model, 'is_turned_on')->dropDownList($model->surrogateStructSectionReader()) ?>

    <?php //echo $form->field($model, 'system_key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->surrogateStructSectionReader('status')) ?>

    <?= $form->field($model, 'is_time_enable')->dropDownList($model->surrogateStructSectionReader('is_time_enable')) ?>
    
    <?php //echo $form->field($model, 'start_day')->textInput() ?>
    
    <?= Html::activeLabel($model, 'start_day') ?>
    <br>
    <?=
     DatePicker::widget([
        'model' => $model,
        'attribute' => 'start_day',
        'value' => $model->start_day,
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>
    <br><br>
    <?= Html::activeLabel($model, 'finish_day') ?>
    <br>
    <?=
     DatePicker::widget([
        'model' => $model,
        'attribute' => 'finish_day',
        'value' => $model->start_day,
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>
    <br><br>
    <?php // $form->field($model, 'finish_day')->textInput() ?>
    

    <?php //echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'is_positive')->textInput() ?>

    <?php //echo $form->field($model, 'rate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>