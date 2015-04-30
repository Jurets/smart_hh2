<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\PatchAsset;
PatchAsset::register($this);
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
            <div class="joinNowWrap">
                <a href="javascript:popupJoinNowOpen()" class="joinNow"><?=Yii::t('app', 'Join Now')?></a>
                <div class="popUpJoinNow">
                    
        <?php echo Html::a(
                         Html::img(Yii::$app->params['images.path'] . '/icon-close.jpeg', ['width'=>'20px', 'id'=>'small-popup-close']),
                         'javascript:javascript:popupJoinNowClose()'
                        );?>
                    <br><br>
                    <?= Html::a(Yii::t('app', 'Join as Customer'), Url::to(['/registration/customer'],true),[]) ?>
                    <br>
                    <?php //echo Html::a(Yii::t('app', 'Join as Performer'), url::to(['/registration/performer'],true), []) ?>
                    <?php echo Html::a(Yii::t('app', 'Join as Performer'), '#', ['class'=>'performer-register'])?>
                    <br>
                </div>
            </div>

            <?=$this->render('switch-language')?>


        </div>
    </div>
</div>

<!-- register popup -->
<div
    data-performer-register-first="<?=Url::to(['registration/performerfirst'],true)?>" 
    data-performer-register-last="<?=Url::to(['registration/performerlast'],true)?>" 
    data-customer-register-first="<?=Url::to(['registration/customerfirst'],true)?>" 
    data-customer-register-last="<?=Url::to(['registration/customerlast'],true)?>" 
    data-title-performer-first="<?=Yii::t('app', 'Registration Performer').' '.Yii::t('app', 'Step'.' 1')?>" 
    data-title-performer-last="<?=Yii::t('app', 'Registration Performer').' '.Yii::t('app', 'Step'.' 2')?>"
    data-title-customer-first="<?=Yii::t('app', 'Registration Customer').' '.Yii::t('app', 'Step'.' 1')?>" 
    data-title-customer-last="<?=Yii::t('app', 'Registration Performer').' '.Yii::t('app', 'Step'.' 2')?>" 
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