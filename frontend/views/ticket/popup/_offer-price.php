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
                <div class="offer-price-greater-zero" style="display:none;">
                    <?= Yii::t('app', 'Price should be a number greater than 0') ?>
                </div>
                <?php echo Html::beginForm(Url::to(['ticket/offer-price']), 'post', ['id' => 'offer_price_form']); ?>
                <?php
                // Hidden Fields
                echo Html::hiddenInput('performer_id', Yii::$app->user->id);
                echo Html::hiddenInput('ticket_id', $model->id);
                if(isset($nextStage)){
                    echo Html::hiddenInput('stage', $nextStage);
                }
                ?>
                <?= Html::hiddenInput('redirect', 'review') ?>
                <div class="apply-form-input">
                <?= Html::input('text', 'price', $model->price); ?>
                </div>
                <div class="apply-form-button">
                <?php echo Html::input('submit', 'submit', yii::t('app', 'Send'), ['class' => 'btn btn-primary']); ?>
                </div>
                <?php echo Html::endForm(); ?>
                <div>&nbsp;</div>

            </div>      
        </div>
    </div>
</div>
