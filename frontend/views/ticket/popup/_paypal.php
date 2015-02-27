<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="popup-paypal-form">
    <p><?= Yii::t('app', 'Confirm') ?></p>
    <p><?= Yii::t('app', 'You will be charged {fullPrice}',['fullPrice' => $price + $price * Yii::$app->params['paypal.fee']/100 ]) ?></p>
    <a href="#" class="btn btn-average btn-dark" ><?= Yii::t('app', 'CONFIRM') ?></a>
    <a href="#" class="btn btn-average btn-delete" ><?= Yii::t('app', 'CANCEL') ?></a>
</div>
