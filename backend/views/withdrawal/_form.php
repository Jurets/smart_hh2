<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Withdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'from_user_id')->textInput() ?>

    <?= $form->field($model, 'method')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
