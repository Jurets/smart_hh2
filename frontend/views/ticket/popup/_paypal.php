<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Commonhelper;
$message = Yii::t('app', 'You will be charged {fullPrice}',['fullPrice' => $price + $price * Yii::$app->params['paypal.fee']/100 ]);
$paypal_message = Commonhelper::messageParser($message, [
    "You will be charged" => Yii::t('app', "You will be charged"),
]);

?>
<div class="popup-paypal-form">
    <p><?= Yii::t('app', 'Confirm') ?></p>
    <p><?=$paypal_message ?></p>
    <a href="<?= $paypalLink ?>" class="btn btn-average btn-dark" ><?= Yii::t('app', 'CONFIRM') ?></a>
    <a href="#" class="btn btn-average btn-delete" ><?= Yii::t('app', 'CANCEL') ?></a>
</div>
