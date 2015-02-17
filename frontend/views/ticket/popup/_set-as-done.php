<?php
use yii\helpers\Html;
?>
<div id="set-as-done-popup" class="pop-up pop-up-edit popup-align-center pop-up-hide">
    <a class="close" href="#">×</a>
    <p class="title"><?php echo Yii::t('app', 'Set As Done') ?></p>
    <br>
    <?php
    $form = yii\widgets\ActiveForm::begin([
                'id' => 'set-as-done-form',
                'action' => ['ticket/set-as-done'],
    ]);
    ?>
    <?php echo Html::label(Yii::t('app', 'Rate a Job')) ?>
    <?=
    kartik\widgets\StarRating::widget([
        'id' => 'set-as-done-star-rating',
        'name' => 'Review[rating]',
        'value' => 3,
        'pluginOptions' => [
            //'size' => '',
            'showClear' => false,
            'showCaption' => false,
            'stars' => 5,
            'min' => 0,
            'max' => 5,
            'step' => 1,
        ],
    ]);
    ?>
    <br>
    <?= $form->field($model, 'message')->textarea(); ?>
    <br>
    <?= $form->field($model, 'from_user_id')->label(false)->hiddenInput(['value' => Yii::$app->user->id]) ?>
    <?= $form->field($model, 'to_user_id')->label(false)->hiddenInput(['value' => $ticket->performer_id]) ?>
    <?= Html::hiddenInput('isOwnTicket', '1'); ?>
    <?= Html::hiddenInput('ticket_id', $ticket->id); ?>
    <?= Html::submitButton(Yii::t('app', 'Send'), ['id' => 'complain_send', 'class' => 'btn btn-success']) ?>
    <?php $form->end(); ?>
</div>