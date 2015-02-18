<?php
/* @var $model common\models\Ticket */
$comments = $model->getCommentsHierarchy();
$newComment = new \common\models\TicketComments();
?>
<div class="comments">
    <p class="title"><?= empty($comments) ? 'No comments' : 'Comments:' ?></p>
    <?php foreach ($comments as $comment): ?>
        <?= $this->render('/ticket/review/_comment-item', ['model' => $comment['comment'], 'showDeleteButton' => true]) ?>
        <?php if (isset($comment['answer'])): ?>
            <?= $this->render('/ticket/review/_comment-item', ['model' => $comment['answer'], 'showDeleteButton' => true]) ?>
        <?php endif; ?>
        <?php if ($comment['comment']->status == \common\models\TicketComments::STATUS_NEW): ?>
            <div id="reply-to-<?= $comment['comment']->id ?>" class="reply-to">
                <p class="title">Write a Reply:</p>
                <?php
                $form = yii\widgets\ActiveForm::begin([
                            'action' => ['ticket/add-comment']
                        ])
                ?>
                <?= $form->field($newComment, 'text')->textarea()->label(false) ?>
                <?= $form->field($newComment, 'ticket_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                <?= $form->field($newComment, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($newComment, 'answer_to')->hiddenInput(['value' => $comment['comment']->id])->label(false) ?>
                <?= yii\helpers\Html::hiddenInput('redirect', 'ticket/view') ?>
                <?= yii\helpers\Html::submitButton(Yii::t('app', 'Reply'), ['id' => 'comment-send', 'class' => 'btn btn-success']) ?>
                <?php yii\widgets\ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <p class="title">Write a Comment:</p>
    <?php
    $form = yii\widgets\ActiveForm::begin([
                'action' => ['ticket/add-comment']
            ])
    ?>
    <?= $form->field($newComment, 'text')->textarea()->label(false) ?>
    <?= $form->field($newComment, 'ticket_id')->hiddenInput(['value' => $model->id])->label(false) ?>
    <?= $form->field($newComment, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
    <?= yii\helpers\Html::hiddenInput('redirect', 'ticket/view') ?>
    <?= yii\helpers\Html::submitButton(Yii::t('app', 'Send'), ['id' => 'comment-send', 'class' => 'btn btn-success']) ?>
    <?php yii\widgets\ActiveForm::end(); ?>
</div>