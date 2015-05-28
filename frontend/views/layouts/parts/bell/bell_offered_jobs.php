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
        "You have a new job offer" => Yii::t('app', "You have a new job offer"),
    ]);
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= $date?>:
        <?= $message?>
    </a>
</li>