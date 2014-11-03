<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <?= $form->field($model, 'is_turned_on')->textInput() ?>

    <?php //echo $form->field($model, 'system_key')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'is_time_enable')->textInput() ?>

    <?= $form->field($model, 'start_day')->textInput() ?>

    <?= $form->field($model, 'finish_day')->textInput() ?>

    <?php //echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'is_positive')->textInput() ?>

    <?php //echo $form->field($model, 'rate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>