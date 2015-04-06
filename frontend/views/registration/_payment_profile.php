<?php
use yii\helpers\Html;
?>

<div class="form-group field-profile-phone">
<?php echo Html::label('select your preferred payment method', NULL, ['class'=>'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?= Html::dropDownList('choise', (!empty($dataSet->choise)) ? $dataSet->choise : '1', [
            '1' => $paymentProfile::V1,
            '2' => $paymentProfile::V2,
            '3' => $paymentProfile::V3
        ],
                ['id'=>'pp_group_choise','class'=>'form-control']
        )?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"></div>
    </div>
</div>


<div class="payment-profile-fieldgroup-title">ACH… 1-2 business days</div>
<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('ach_routing_number'), 'ach_1', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('ach_routing_number', $paymentProfile->ach_routing_number, ['id' => 'ach_1', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('ach_routing_number')?></div>
    </div>
</div>

<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('ach_account_name'), 'ach_2', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('ach_account_name', $paymentProfile->ach_account_name, ['id' => 'ach_2', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('ach_account_name')?></div>
    </div>
</div>

<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('ach_account_number'), 'ach_3', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('ach_account_number', $paymentProfile->ach_account_number, ['id' => 'ach_3', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('ach_account_number')?></div>
    </div>
</div>
<div class="payment-profile-fieldgroup-title">Paypal… 3-5 business days</div>
<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('paypal'), 'p_p', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('paypal', $paymentProfile->paypal, ['id' => 'p_p', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('paypal')?></div>
    </div>
</div>
<div class="payment-profile-fieldgroup-title">Check mailing…up<br>to 10 business days</div>
<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('mailing_address'), 'm_a', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('mailing_address', $paymentProfile->mailing_address, ['m_a' => 'ach_1', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('mailing_address')?></div>
    </div>
</div>

<div class="form-group field-profile-phone">
<?php echo Html::label($paymentProfile->getAttributeLabel('fullname'), 'f_n', ['class' => 'col-lg-2 control-label']) ?>
    <div class="col-lg-3">
    <?php echo Html::textInput('fullname', $paymentProfile->fullname, ['id' => 'f_n', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-7">
        <div class="help-block render-errors"><?=$paymentProfile->renderErrors('fullname')?></div>
    </div>
</div>
<div class="payment-profile-fieldgroup-title">&nbsp;</div>