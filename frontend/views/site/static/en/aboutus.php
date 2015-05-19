<?php
use yii\helpers\Url;
use common\components\Commonhelper;
?>
<?php
$this->title = "About Us";
$this->params['breadcrumbs'][] = $this->title;
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
            
            <h1>About Helping Hut</h1>
            <p>about us</p><br>
            <p>Helping Hut is a comprehensive online resource for providing you with the help you desire. Founded on the premise of creating your own workplace, Helping Hut enables you to reach out to the members of your community to ensure your needs are met. We streamline the process by acting as a hub of communication. Simply register as a client or helper, and instantly receive an all-inclusive list of tasks, job listings, and Helpers. If you register as a client, you’ll be able to choose from an elite list of helpers who are eager to help you reach your goal. As a Helper, you will receive automatic notifications when there a job that best meets your skillset and receive detailed reviews for a job well done. Ultimately, our goal to ensure no job gets left undone and no customer is left unsatisfied. </p>

            <p>Helping Hut: Where help is one click away.</p>

            <h3>Mission</h3>
            <p>To simply the process of finding and providing help. </p>

            <h3>Vision</h3>
            <p>To be the best online resource job listings</p>
            
            <!-- end content -->
        </div>
        <br>
        <a style="width:250px;" href="<?=Url::to('#')?>" class="btn btn-big btn-width joinNow"><?=Yii::t('app', 'WANNA BE A HELPER'.'?')?></a>
        &nbsp;
        <a style="width:250px;" href="<?=Url::to(['/ticket/create'],true)?>" class="btn btn-big btn-width btn-red"><?=Yii::t('app', 'CREATE A TASK')?></a>
        
    </div>
</div>


<div class="clear"></div>