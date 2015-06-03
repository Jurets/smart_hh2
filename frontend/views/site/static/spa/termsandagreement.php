<?php
use yii\helpers\Url;
use common\components\Commonhelper;

Yii::$app->language = Commonhelper::getLanguage();

?>
<?php
$this->title = Yii::t('app', 'Terms & Agreement');
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->language = Commonhelper::getLanguage();

?>


<div class="row">
    <div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">



        <div class="sidebar">
            <ul class="sidebar-holder">
                <li>
                    <a href="<?=Url::to(['site/aboutus', 'language'=>Commonhelper::getLanguage()],true)?>"><img alt="icon" src="../../frontend/web/images/categories/AllTask.png"><?=Yii::t('app','About Us')?></a>
                </li>
                <li>
                    <a href="<?=Url::to(['site/faq', 'language'=>Commonhelper::getLanguage()],true)?>"><img alt="icon" src="../../frontend/web/images/categories/Miscellaneous.png"><?=Yii::t('app','FAQ')?></a>
                </li>
                <li>
                    <a href="<?=Url::to(['site/termsandagreements', 'language'=>Commonhelper::getLanguage()],true)?>"><img alt="icon" src="../../frontend/web/images/categories/webDisignInternet.png"><?=Yii::t('app', 'Terms & Agreement')?></a>
                </li>
                <li>
                    <a href="<?=Url::to(['site/contactus', 'language'=>Commonhelper::getLanguage()],true)?>"><img alt="icon" src="../../frontend/web/images/categories/VirtualAssistant.png"><?=Yii::t('app','Contact US')?></a>
                </li>
            </ul>
        </div>



    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="static-right-text">
            <!-- begin content -->
            
            ...
            
            <!-- end content -->
        </div>
        <br>
        <a style="width:250px;" href="<?=Url::to('#')?>" class="btn btn-big btn-width joinNow"><?=Yii::t('app', 'WANNA BE A HELPER').'?'?></a>
        &nbsp;
        <a style="width:250px;" href="<?=Url::to(['/ticket/create'],true)?>" class="btn btn-big btn-width btn-red"><?=Yii::t('app', 'CREATE A TASK')?></a>
        
    </div>
</div>


<div class="clear"></div>