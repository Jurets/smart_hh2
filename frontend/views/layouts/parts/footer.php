<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\SeoHelper;
use common\components\FooterContentManager;
?>
<?php
$FCM = new FooterContentManager(Yii::$app->params['language']);
?>
<div class="footer">
    <?=$this->render('footer/footer-top', ['FCM'=>$FCM])?>
    <?=$this->render('footer/footer-nav', ['categoryList'=>$FCM->getCategoryStruct()])?>
    
    <?php 
        if(isset($this->params['seo-zip-list'])){
            $urlList2 = $this->params['seo-zip-list'];
            echo $this->render('footer/seo_zip', ['list'=>$urlList2]);
        }
    ?>
    
    <?php
        $urlList1 = SeoHelper::FooterIndexStructure();
        if(!is_null($urlList1)){
            echo $this->render('footer/seo_category_city', ['list'=>$urlList1]);
        }
    ?>
    
</div>
