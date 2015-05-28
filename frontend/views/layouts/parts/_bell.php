<?php
    $bellNotificationCount = Yii::$app->notification->getUnreadCount();
?>
<a href="#" class="" <?= $bellNotificationCount ? 'data-toggle="dropdown"' : '' ?>>
    <img src="/images/icon-bell.png" alt="bell"/>
    <span><?= $bellNotificationCount ?></span>&nbsp;
        <?=Yii::t('app', 'new offers')?>
</a>
<?php if($bellNotificationCount): ?>
    <ul class="dropdown-menu" role="menu">
    <?php foreach (Yii::$app->notification->getUnread() as $notification): ?>
            <?= $this->render('bell/' . $notification['type'], ['notification' => $notification]) ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
