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
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= $date?>:
        <?= $notification->message ?>
    </a>
</li>