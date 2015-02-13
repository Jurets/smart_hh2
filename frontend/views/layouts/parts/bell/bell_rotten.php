<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id']]) ?>">
        <?= Yii::t('app','Your job {title} is on {date}',[
            'title' => Html::encode($ticket['title']),
            'date' => Html::encode($ticket['date']),
        ])?>
    </a>
</li>