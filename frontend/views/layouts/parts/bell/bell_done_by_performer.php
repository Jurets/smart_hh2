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
        "Performer has done a job. Please write a review" => Yii::t("app", "Performer has done a job. Please write a review"),
    ]);
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= $date?>:
        <?= $message ?>
    </a>
</li>