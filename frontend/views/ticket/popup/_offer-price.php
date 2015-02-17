<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model common\models\Ticket */
?>
<div id="popup-OfferPrice" class="pos-relativer">
    <div class="popup-apply  pop-up-hide popup-apply-ext1">
        <div class="popup-apply-header">x</div>
        <div class="popup-apply-content">
            <div class="popup-apply-form">
                <?= Yii::t('app', 'Offer Price') ?>
                <div class="ajax-offer-price-form-errors"></div>
                <div class="offer-form-return-message"></div>
                <?php echo Html::beginForm(Url::to(['offer-price']), 'post', ['id' => 'offer_price_form']); ?>
                <?php
                // Hidden Fields
                echo Html::hiddenInput('performer_id', Yii::$app->user->id);
                echo Html::hiddenInput('ticket_id', $model->id);
                ?>
                <div class="apply-form-input">
                <?= Html::input('text', 'price', $model->price); ?>
                </div>
                <div class="apply-form-button">
                <?php echo Html::button(yii::t('app', 'Submit'), ['class' => 'btn btn-primary']); ?>
                </div>
                <?php echo Html::endForm(); ?>
                <div>&nbsp;</div>

            </div>      
        </div>
    </div>
</div>
