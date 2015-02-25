<?php

use yii\helpers\Html;
/*@var $notification \common\models\Notification*/
?>
<li>
    <a href="<?= $notification->link ?>">
        <?= Html::encode($notification->date)?>:
        <?= Html::encode($notification->message) ?> <span class="red">+<?= Html::encode($notification->proposal_count) ?></span>
    </a>
</li>