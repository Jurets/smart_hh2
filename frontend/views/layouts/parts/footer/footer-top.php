<?php
use yii\helpers\Url;
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

        <div class="column column-nav col-xs-6 col-sm-6 col-md-6 col-lg-2">
            <ul>
                <li><a href="<?=$FCM->partialOutput('About Us')['reference']?>"><?=Yii::t('app','About Us')?></a></li>
                <li><a href="<?=$FCM->partialOutput('FAQ')['reference']?>"><?=Yii::t('app','FAQ')?></a></li>
                <li><a href="<?=$FCM->partialOutput('Terms & Agreement')['reference']?>"><?=Yii::t('app', 'Terms & Agreement')?></a></li>
                <li><a href="<?=$FCM->partialOutput('Contact US')['reference']?>"><?=Yii::t('app','Contact US')?></a></li>
            </ul>
        </div>
        <div class="clear"></div>

         <?php } ?>
    </div>