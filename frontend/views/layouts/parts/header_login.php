<?php
use yii\helpers\Url;
use yii\helpers\Html;

$currentUser = Yii::$app->user->getIdentity();
$allNewTicketsCommentsCount = ($currentUser !== null) ? $currentUser->getNewTicketCommentsCount() : 0;
?>
<!-- header login -->

<div class="header header-login row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
        <a href="<?php echo Yii::$app->homeUrl?>" class="logo"><img src="/images/logo.png" alt="HelpingHut"/></a>
    </div>
    <div class="top-nav col-xs-12 col-sm-12 col-md-12 col-lg-9">
        <div class="status">
            <span>
            <a href="#" class="" <?= $allNewTicketsCommentsCount ? 'data-toggle="dropdown"' : '' ?>><img src="/images/icon-letter.png" alt="letter"/>
            <?= Yii::t('app', '{n, plural, =1{<span>#</span> new message} other{<span>#</span> new messages}}', [
                'n' => $allNewTicketsCommentsCount
                ]); ?>
            </a>
            <?php if($allNewTicketsCommentsCount): ?>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach($currentUser->getTicketsWithNewComments() as $ticket): ?>
                    <li><a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id']])?>"><?= Html::encode($ticket['title'])?> <span class="red">+<?= Html::encode($ticket['comments_count']) ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            </span>
            <a href="#" class=""><img src="/images/icon-bell.png" alt="bell"/><span>115</span>&nbsp;<?=Yii::t('app', 'new offers')?></a>           
            <?php if(Yii::$app->controller->action->id === 'profile'){ ?>
            <a href="<?=Url::to(['/user/cabinet'],true)?>" class=""><img src="/images/icon-pen.png" alt="pen"><?=Yii::t('app','Edit Profile')?></a>
                <?php }else{ ?>
            <a href="<?=Url::to(['/user/profile'],true)?>" class=""><img src="/images/icon-pen.png" alt="pen"><?=Yii::t('app','Profile')?></a>
                <?php } ?>
            <a href="<?=Url::to(['/user/logout'],false)?>" data-method="post" class=""><img src="/images/icon-logout.png" alt=""/><?=Yii::t('app', 'Log Out')?></a>
        </div>

        <select id="language">
            <option value="0" data-imagesrc="/images/language-icon.png">English</option>
            <option value="1" data-imagesrc="/images/language-icon.png">English</option>
        </select>



    </div>
</div>
