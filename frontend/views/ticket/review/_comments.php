<?php
/*@var $model common\models\Ticket*/
$comments = $model->getCommentsHierarchy();
?>
<div class="comments">
    <p class="title"><?= empty($comments) ? 'No comments' : 'Comments:'?></p>
    <?php foreach($comments as $comment): ?>
        <?= $this->render('_comment-item', ['model' => $comment['comment']]) ?>
        <?php if(isset($comment['answer'])): ?>
            <?= $this->render('_comment-item', ['model' => $comment['answer']]) ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>