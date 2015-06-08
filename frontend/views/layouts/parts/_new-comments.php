<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\Commonhelper;

$currentUser = Yii::$app->user->getIdentity();
$allNewTicketsCommentsCount = ($currentUser !== null) ? ($currentUser->getNewTicketCommentsCount() + $currentUser->getNewRepliesCommentsCount()) : 0;
?>
<a href="#" class="" <?= $allNewTicketsCommentsCount ? 'data-toggle="dropdown"' : '' ?>><img src="/images/icon-letter.png" alt="letter"/>
    <?php
    $buffTxt = Yii::t('app', '{n, plural, =1{<span>#</span> new messages} other{<span>#</span> new messages}}', [
        'n' => $allNewTicketsCommentsCount
    ]);
    $buffTxt = Commonhelper::messageParser($buffTxt, ['new messages' => Yii::t('app', 'new messages')]);
    echo $buffTxt;
    ?>
</a>
    <?php if ($allNewTicketsCommentsCount): ?>
    <ul class="dropdown-menu" role="menu">
        <?php $ticketsWithNewComments = $currentUser->getTicketsWithNewComments(); ?>
    <?php foreach ($ticketsWithNewComments['newReplies'] as $ticket): ?>
            <li><a href="<?= Url::to(['/ticket/review', 'id' => $ticket['id']]) ?>"><?= Yii::t('app', 'Reply') . ': ' . Html::encode($ticket['title']) ?> <span class="red">+<?= Html::encode($ticket['comments_count']) ?></span></a></li>
    <?php endforeach; ?>
    <?php foreach ($ticketsWithNewComments['newComments'] as $ticket): ?>
            <li><a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id'], 'reply' => true]) ?>"><?= Html::encode($ticket['title']) ?> <span class="red">+<?= Html::encode($ticket['comments_count']) ?></span></a></li>
    <?php endforeach; ?>            
        <li><span class="btn btn-width btn-average" id="clear-comments-btn" data-url="<?= Url::to(['/site/clear-new-comments']) ?>"><?=Yii::t("app", "Clear")?></span></li>
    </ul>
<?php endif; ?>

