<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TicketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'id_category') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'is_turned_on') ?>

    <?php // echo $form->field($model, 'system_key') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_time_enable') ?>

    <?php // echo $form->field($model, 'start_day') ?>

    <?php // echo $form->field($model, 'finish_day') ?>

    <?php // echo $form->field($model, 'performer_id') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'is_positive') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
