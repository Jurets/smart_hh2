<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/review', 'id' => $ticket['id']]) ?>">
        <?= Html::encode($ticket['date'])?>:
        
        <?= Yii::t('app','You have been accepted for a job: {title}',[
            'title' => Html::encode($ticket['title']),
        ])?>
    </a>
</li>