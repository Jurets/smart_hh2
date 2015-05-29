<?php

use yii\web\View;
use yii\helpers\Url;
?>
<div class="widget diplomas">
    <h1><?=Yii::t('app',"My").' '?><span class="red"><?= count($diplomas) ?></span><?=' '.Yii::t('app', "Diplomas")?></h1> 

<?php foreach ($diplomas as $diploma) { ?>
        <a href="#" class="icon-items">
            <img style="width:116px;" src="<?=Yii::$app->params['upload.url'].'/'.$diploma->code?>" alt="diplom">                                
        </a>       
<?php } ?>
</div>
<!--<div class="widget diplomas">
            <h1>My <span class="red">4</span> Diplomas</h1>
            <a href="#" class="icon-items">
                <img src="/images/icon-diplom.jpg" alt="diplom"/>                                
            </a>                         
            <a href="#" class="icon-items">
                <img src="/images/icon-diplom.jpg" alt="diplom"/>
            </a>
            <a href="#" class="icon-items">
                <img src="/images/icon-diplom.jpg" alt="diplom"/>
            </a>
            <a href="#" class="icon-items">
                <img src="/images/icon-diplom.jpg" alt="diplom"/>
            </a>                           

        </div>-->

