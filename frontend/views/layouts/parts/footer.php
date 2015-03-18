<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\FooterContentManager;
?>
<?php
$FCM = new FooterContentManager(Yii::$app->params['language']);
    $categoryStruct = $FCM->getCategoryStruct();
    //var_dump($categoryStruct);
?>
<div class="footer">
    <?=$this->render('footer/footer-top', ['FCM'=>$FCM])?>
    <?=$this->render('footer/footer-nav', ['FCM'=>$FCM])?>
</div>
