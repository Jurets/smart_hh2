<?php

use yii\helpers\Html;
use common\components\Commonhelper;
/*@var $notification \common\models\Notification*/
?>
<?php
    $date = Html::encode($notification->date);
    $date = Commonhelper::convertDate($date);
    if($date === '0000-00-00 00:00:00'){
        $date = '';
    }
    $message = Commonhelper::messageParser($notification->message, [
        "Your job" => Yii::t('app', "Your job"),
        "is on" => Yii::t('app', "is on"),
    ]);
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= $date?>:
        <?= $message ?>
    </a>
</li>