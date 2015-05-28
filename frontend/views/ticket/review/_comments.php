<?php
/*@var $model common\models\Ticket*/
$comments = $model->getCommentsHierarchy();
$newComment = new \common\models\TicketComments();
?>
<div class="comments">
    <p class="title"><?= empty($comments) ? Yii::t('app', 'No Comments') : Yii::t('app', 'Comment').':'?></p>
    <?php foreach($comments as $comment): ?>
        <?= $this->render('_comment-item', ['model' => $comment['comment']]) ?>
        <?php if(isset($comment['answer'])): ?>
            <?= $this->render('_comment-item', ['model' => $comment['answer']]) ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <p class="title"><?=Yii::t('app', "Write a Comment")?>:</p>
    <?php $form = yii\widgets\ActiveForm::begin([
        'action' => ['ticket/add-comment']
    ]) ?>
        <?= $form->field($newComment, 'text')->textarea()->label(false)?>
        <?= $form->field($newComment, 'ticket_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field($newComment, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
        <?= yii\helpers\Html::hiddenInput('redirect', 'ticket/review') ?>
        <?= yii\helpers\Html::submitButton(Yii::t('app', 'Send'), ['id' => 'comment-send', 'class' => 'btn btn-success']) ?>
    <?php yii\widgets\ActiveForm::end(); ?>
</div>