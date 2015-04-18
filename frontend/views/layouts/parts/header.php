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
                         Html::img(Yii::$app->params['images.path'] . '/icon-close.jpeg', ['width'=>'20px']),
                         'javascript:javascript:popupJoinNowClose()'
                        );?>
                    <br><br>
                    <?= Html::a(Yii::t('app', 'Join as Customer'), Url::to(['/registration/customer'],true),[]) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Join as Performer'), url::to(['/registration/performer'],true), []) ?>
                    <br>
                </div>
            </div>

            <?=$this->render('switch-language')?>


        </div>
    </div>
</div>