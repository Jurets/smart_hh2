<?php
use Yii;
use yii\helpers\Url;
use common\components\Commonhelper;

Yii::$app->language = Commonhelper::getLanguage();
?>
<div class="custom-error-layout">
    <div class="error-block">
        <img alt="HelpingHut" src="/images/logo.png">
        <div>&nbsp;</div>
        <h4>
            #<?= $error->exception->statusCode; ?>&nbsp;
        </h4>
            <?=Yii::t('app', 'the page cannot be found')?>
        <p><a href="<?=Url::to('/',true)?>"><?=Yii::t('app','please return back')?></a></p>
    </div>
</div>

<style>
    .custom-error-layout {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        overflow: auto;
    }
    .error-block {
        width: 300px;
        height: 300px;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        padding-left: 9%;
    }
    h4 {
        display: inline;
    }
    a {
        text-decoration: none;
        color: navy;
    }
</style>
