<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<!-- header login -->

<div class="header header-login row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
        <a href="<?php echo Yii::$app->homeUrl?>" class="logo"><img src="/images/logo.png" alt="HelpingHut"/></a>
    </div>
    <div class="top-nav col-xs-12 col-sm-12 col-md-12 col-lg-9">
        <div class="status">
            <span id="new-comments-container">
                <?= $this->render('_new-comments') ?>
            </span>
            <a href="#" class=""><img src="/images/icon-bell.png" alt="bell"/><span><?=count(Yii::$app->user->getIdentity()->getBellNotifications())?></span>&nbsp;<?=Yii::t('app', 'new offers')?></a>           
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
