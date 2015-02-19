<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/review', 'id' => $ticket['id']]) ?>">
        <?= Html::encode($ticket['date'])?>:
        
        <?= Yii::t('app','Performer has done a job. Please write a review: {title}',[
            'title' => Html::encode($ticket['title']),
        ])?>
    </a>
</li>