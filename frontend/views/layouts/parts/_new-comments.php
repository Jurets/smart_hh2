<?php

use yii\helpers\Url;
use yii\helpers\Html;

$currentUser = Yii::$app->user->getIdentity();
$allNewTicketsCommentsCount = ($currentUser !== null) ? $currentUser->getNewTicketCommentsCount() : 0;
?>
<a href="#" class="" <?= $allNewTicketsCommentsCount ? 'data-toggle="dropdown"' : '' ?>><img src="/images/icon-letter.png" alt="letter"/>
    <?=
    Yii::t('app', '{n, plural, =1{<span>#</span> new message} other{<span>#</span> new messages}}', [
        'n' => $allNewTicketsCommentsCount
    ]);
    ?>
</a>
    <?php if ($allNewTicketsCommentsCount): ?>
    <ul class="dropdown-menu" role="menu">
    <?php foreach ($currentUser->getTicketsWithNewComments() as $ticket): ?>
            <li><a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id'], 'reply' => true]) ?>"><?= Html::encode($ticket['title']) ?> <span class="red">+<?= Html::encode($ticket['comments_count']) ?></span></a></li>
    <?php endforeach; ?>
        <li><span class="btn btn-width btn-average" id="clear-comments-btn" data-url="<?= Url::to(['/site/clear-new-comments']) ?>">Clear</span></li>
    </ul>
<?php endif; ?>

