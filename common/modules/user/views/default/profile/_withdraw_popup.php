<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="withdrawal-popup-wrapper">
    <div class="pop-up pop-up-edit withdrawal-popup">
        <p class="title"><?=Yii::t('app','Withdrawals')?></p>
        <?php if(is_null($paymentProfile) || $paymentProfile->checkFieldsEmpty() === FALSE) { ?>
        <div class="wd-error"><?=Yii::t('app','You has not any payee data. Setup it in  users cabinet')?></div>
        <?php }else{ ?>
        <div class="wd-message"></div>
        <div class="wd-error"></div>
        <form id="withdrawals_form" method="post" action="<?=Url::to(['/user/withdrawals'], true)?>">
            <fieldset>
                <a class="close wd-close" href="#">×</a>
<?=Html::hiddenInput('user_id', $profile->user_id)?>
<?=Html::dropDownList('choise', $paymentProfile->choise, $paymentProfile->varriantsListCreate(), ['style'=>'width:50%'])?><br>
<p>Amount</p>           
<?=Html::textInput('amount') ?><br><br>
            <input id="wd-submit" class="btn btn-average btn-width" type="submit" value="SEND">
            </fieldset>
        </form>
       <?php } ?> 
    </div>
</div>