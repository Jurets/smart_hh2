<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<?php
$ticket_title = Yii::t('app', 'User Cabinet');
$this->title = $ticket_title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="person-profile row">
    <div class="info-1 col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <?php echo $this->render('_cabinet-user-item', [
            'profile' => $profile,
        ])?>
    </div>

    <div class="info-2 col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <?php echo $this->render('_user-contacts', [
            'profile' => $profile,
        ]) ?>
    </div>   

</div>
<div class="user-cabinet-content">
    
    <div class='payment_history_main'>
        <?=$this->render('cabinet/payment_history',[
            'paymentHistoryDataProvider' => $paymentHistoryDataProvider,
            'switchWindow' => $switchWindow,
            'amountAll' => $amountAll
        ])?>
    </div>
    <div class="clearfix"></div>
    
    
            <?=$this->render('_cabinet-category-item', [
                'userSpecialities' => $userSpecialities,
            ])
            ?>
 </div>    
     <div class="clearfix"></div>    

</div>       
<section>
    <h1 class="left">My <span class="red">Diplomas</span></h1>
    <a href="#" data-sign="Diploma" class="btn btn-average right">NEW LICENSE / DIPLOMA</a>
    <table class="table table-striped" id="table_diploma">
        <thead>
            <tr>
                <th><?php echo Yii::t('app', '#')?></th>
                <th><?php echo Yii::t('app','Title')?></th>
                <th><?php echo Yii::t('app','Type')?></th>
                <th><?php echo Yii::t('app', 'Size')?></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="diploma-wrapper">
    <?php echo $this->render('_table-diploma',['userDiploma' => $userDiploma,]) ?>
        </tbody>
    </table>
    <div data-DiplomaDell="<?php echo Url::to(['/user/diploma_dell'], true)?>"></div>
</section>

<section>
    <h1 class="left">My <span class="red">Verification Docs</span></h1>
    <a href="#" data-sign="Verid" class="btn btn-average right">NEW DOCUMENT</a>
    <table class="table table-striped" id="table_verid">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Size</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="verid-wrapper">
    <?php echo $this->render('_verificationid-table', ['userVerid'=>$userVerid]) ?>
         </tbody>
    </table>
    <div data-VeridDell="<?php echo Url::to(['/user/verid_dell'], true)?>"></div>
</section>

<section>
    <h1 class="left">My <span class="red">Links To Other Networks</span></h1>
    <div class="clearfix"></div>
    <?php foreach($userSocialNetworks as $userSocialNetwork): ?>
        <?= $this->render('cabinet/social_network_form', ['model' => $userSocialNetwork]) ?>
    <?php endforeach; ?>
</section>



<div class="clear"></div>


<div data-CallPopup="<?php echo Url::to(['/user/popup_render'])?>"></div>