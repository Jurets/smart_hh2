<?php
$currentUser = Yii::$app->user->getIdentity();
$bellNotificationCount = ($currentUser !== null) ? $currentUser->getBellNotificationsCount() : 0;
?>
<a href="#" class="" <?= $bellNotificationCount ? 'data-toggle="dropdown"' : '' ?>>
    <img src="/images/icon-bell.png" alt="bell"/>
    <span><?= $bellNotificationCount ?></span>&nbsp;
        <?=Yii::t('app', 'new offers')?>
</a>
<?php if($bellNotificationCount): ?>
    <ul class="dropdown-menu" role="menu">
    <?php foreach ($currentUser->getBellNotifications() as $ticket): ?>
            <?= $this->render('bell/' . $ticket['type'], ['ticket' => $ticket]) ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
