<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\PatchAsset;
PatchAsset::register($this);

Yii::$app->language = common\components\Commonhelper::getLanguage();

?>
<div class="header row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="<?php echo Yii::$app->homeUrl?>" class="logo"><img src="/images/logo.png" alt="HelpingHut"/></a>
    </div>
    <div class=" col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="top-nav">
            <!--
            <form id="search" action="" method="post">
                <fieldset>
                    <input type="text" placeholder="Search for jobs or helpers you need"/>
                    <input type="submit" value=""/>
                </fieldset>
            </form>
            -->
            <a href="<?=Url::to(['/user/login'],true)?>" class="logIn"><?=Yii::t('app', 'Log In')?></a>
            <a href="#" class="joinNow"><?=Yii::t('app', 'Join Now')?></a>

            <?=$this->render('switch-language')?>


        </div>
    </div>
</div>

<!-- register popup -->
<div
    data-user-register-first="<?=Url::to(['/registration/userfirst'],true)?>" 
    data-title-user-first="<?=Yii::t('app', 'Sign Up').' '.Yii::t('app', 'Step').' 1'?>" 
    data-performer-register-last="<?=Url::to(['registration/performerlast'],true)?>" 
    data-title-performer-last="<?=Yii::t('app', 'Performer Registration').' '.Yii::t('app', 'Step').' 2'?>" 
    data-customer-register-last="<?=Url::to(['registration/customerlast'],true)?>" 
    data-title-customer-last="<?=Yii::t('app', 'Customer Registration').' '.Yii::t('app', 'Step').' 2'?>" 
    ></div>
<div id="registerPopupWindow" class="pop-up-hide"></div>

<?php if(isset($this->params['regmode']) && isset($this->params['reguser'])) {
        $regmode = $this->params['regmode'];
        $reguser = $this->params['reguser'];
    }else{
        $regmode = '';
        $reguser = '';
    } 
 ?>
<div data-regmode="<?=$regmode?>" data-reguser="<?=$reguser?>"></div>
<style>
    .ui-widget-header {
        background: none;
        color: inherit;
        border: 0;
    }
</style>
<!-- -->