<?php
use yii\helpers\Url;
use common\components\Commonhelper;
?>
<div class="row footer-top">
        <div class="column column-logo col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <a href="<?=Url::to(['/'], true)?>" class="footer-logo"><img src="/images/logo-footer.png" alt="HelpingHut"/></a>
            <div class="copyright">&COPY; 2014</div>

         <?php if( $FCM->simpleValidate() ) { ?>   
            
            
        </div>
        <div class="column column-help col-xs-6 col-sm-6 col-md-6 col-lg-4">
            <a href="<?=$FCM->partialOutput('Instant help in a click')['reference']?>"><?=Yii::t('app', 'Instant help in a click')?>.</a>
        </div>
        <div class="column column-social-link col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <p>Join Us on</p>
        <ul class="sicial-link">
            
        <?php foreach($FCM->partialOutput('social network') as $network){?>
            <li><a href="<?=$network['reference']?>"><img src="/images/<?=$network['img']?>"></a></li>
        <?php } ?>
        </ul>
            <div class="clear"></div>
        </div>
        <?php // временно закомментировано, предполагается переработка - вывод ссылок перенесен ниже ?>
        <!--
        <div class="column column-nav col-xs-6 col-sm-6 col-md-6 col-lg-2">
            <ul>
                <li><a href="<?php //echo $FCM->partialOutput('About Us')['reference']?>"><?php //echo Yii::t('app','About Us')?></a></li>
                <li><a href="<?php //echo $FCM->partialOutput('FAQ')['reference']?>"><?php //echo Yii::t('app','FAQ')?></a></li>
                <li><a href="<?php //echo $FCM->partialOutput('Terms & Agreement')['reference']?>"><?php //echo Yii::t('app', 'Terms & Agreement')?></a></li>
                <li><a href="<?php //echo $FCM->partialOutput('Contact US')['reference']?>"><?php //echo Yii::t('app','Contact US')?></a></li>
            </ul>
        </div>
        -->
        <?php // переработка - пока языки хардкодятся ?>
        <div class="column column-nav col-xs-6 col-sm-6 col-md-6 col-lg-2">
            <ul>
                <li><a href="<?=Url::to(['site/aboutus', 'language'=>Commonhelper::getLanguage()],true)?>"><?=Yii::t('app','About Us')?></a></li>
                <li><a href="<?=Url::to(['site/faq', 'language'=>  Commonhelper::getLanguage()],true)?>"><?=Yii::t('app','FAQ')?></a></li>
                <li><a href="<?=Url::to(['site/termsandagreements','language'=>Commonhelper::getLanguage()],true)?>"><?=Yii::t('app', 'Terms & Agreement')?></a></li>
                <li><a href="<?=Url::to(['site/contactus','language'=>Commonhelper::getLanguage()],true)?>"><?=Yii::t('app','Contact US')?></a></li>
            </ul>
        </div>
        <?php // окончание переработки ?>
        
        <div class="clear"></div>

         <?php } ?>
    </div>