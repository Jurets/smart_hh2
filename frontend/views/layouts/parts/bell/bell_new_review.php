<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/user/default/profile']) ?>">
        <?= Html::encode($ticket['date'])?>:
        
        <?= Yii::t('app','You have a new review!')?>
    </a>
</li>