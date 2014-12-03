<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\PatchAsset;
PatchAsset::register($this);
?>
<div class="header row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <a href="<?=Yii::$app->urlManager->baseUrl?>" class="logo"><img src="/images/logo.png" alt="HelpingHut"/></a>
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
            <a href="/user/login" class="logIn"><?=Yii::t('app', 'Log In')?></a>
            <div class="joinNowWrap">
                <a href="javascript:popupJoinNowOpen()" class="joinNow"><?=Yii::t('app', 'Join Now')?></a>
                <div class="popUpJoinNow">
                    
        <?php echo Html::a(
                         Html::img(Yii::$app->params['images.path'] . '/icon-close.jpeg', ['width'=>'20px']),
                         'javascript:javascript:popupJoinNowClose()'
                        );?>
                    <br><br>
                    <?= Html::a(Yii::t('app', 'Join as Customer'), Url::to('registration/customer'), []) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Join as Performer'), url::to('registration/performer'), []) ?>
                    <br>
                </div>
            </div>

            <select id="language">
                <option value="0" data-imagesrc="/images/language-icon.png">English</option>
                <option value="1" data-imagesrc="/images/language-icon.png">English</option>
            </select>


        </div>
    </div>
</div>