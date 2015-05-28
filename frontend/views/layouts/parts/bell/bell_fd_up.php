<?php
use common\components\Commonhelper;
use yii\helpers\Html;
/*@var $notification \common\models\Notification*/
?>
<?php
    $date = Html::encode($notification->date);
    $date = Commonhelper::convertDate($date);
    if($date === '0000-00-00 00:00:00'){
        $date = '';
    }
    $message = Commonhelper::messageParser($notification->message, [
        "Don't miss a job You apllied to" => Yii::t('app', "Don't miss a job You apllied to"),
        "is on" => Yii::t('app', "is on"),
    ]);
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= $date?>:
        <?= $message ?>
    </a>
</li>