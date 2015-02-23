<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/review', 'id' => $ticket['id']]) ?>">
        <?= Yii::t('app','Don\'t miss a job You apllied to: {title} is on {date}',[
            'title' => Html::encode($ticket['title']),
            'date' => Html::encode($ticket['date']),
        ])?>
    </a>
</li>