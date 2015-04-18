<?php
/* test session */
$check_usr_diff = Yii::$app->session['id_usr_from_profile'];
$currentUsr = Yii::$app->user->id;



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
            <span id="bell-container">
                <?= $this->render('_bell') ?>
            </span>
            <?php if(Yii::$app->controller->action->id === 'profile'){ ?>
            
                <?php if($check_usr_diff !== 0 && ($check_usr_diff !== $currentUsr) ) { ?>
                        <a href="<?=Url::to(['/user/profile'],true)?>" class=""><img src="/images/icon-pen.png" alt="pen"><?=Yii::t('app','My Profile')?></a>
                <?php }else{ ?>
                
            <a href="<?=Url::to(['/user/cabinet'],true)?>" class=""><img src="/images/icon-pen.png" alt="pen"><?=Yii::t('app','Edit Profile')?></a>
                <?php } ?>
            
                <?php }else{ ?>
            <a href="<?=Url::to(['/user/profile'],true)?>" class=""><img src="/images/icon-pen.png" alt="pen"><?=Yii::t('app','Profile')?></a>
                <?php } ?>
            <a href="<?=Url::to(['/user/logout'],false)?>" data-method="post" class=""><img src="/images/icon-logout.png" alt=""/><?=Yii::t('app', 'Log Out')?></a>
        </div>

        <?=$this->render('switch-language')?>


    </div>
</div>
