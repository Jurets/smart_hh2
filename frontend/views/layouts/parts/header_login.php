<?php
use Yii;
?>
<!-- header login -->

<div class="header header-login row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
        <a href="<?php echo Yii::$app->urlManager->baseUrl?>" class="logo"><img src="/images/logo.png" alt="HelpingHut"/></a>
    </div>
    <div class="top-nav col-xs-12 col-sm-12 col-md-12 col-lg-9">
        <!--
        <form id="search">
            <fieldset>
                <input type="text" placeholder="Search for jobs or helpers you need"/>
                <input type="submit" value=""/>
            </fieldset>
        </form>
        -->
        <div class="status">
            <a href="#" class=""><img src="/images/icon-letter.png" alt="letter"/><span>1</span>&nbsp;<?=Yii::t('app', 'new message')?></a>
            <a href="#" class=""><img src="/images/icon-bell.png" alt="bell"/><span>115</span>&nbsp;<?=Yii::t('app', 'new offers')?></a>
            <a href="#" class=""><img src="/images/icon-pen.png" alt="pen"/><?=Yii::t('app','Edit Profile')?></a>
            <a href="/user/logout" data-method="post" class=""><img src="/images/icon-logout.png" alt=""/><?=Yii::t('app', 'Log Out')?></a>
        </div>

        <select id="language">
            <option value="0" data-imagesrc="/images/language-icon.png">English</option>
            <option value="1" data-imagesrc="/images/language-icon.png">English</option>
        </select>



    </div>
</div>
