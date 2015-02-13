<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id']]) ?>">
        <?= Html::encode($ticket['date'])?>:
        <?= Html::encode($ticket['title']) ?> <?= Yii::t('app','has new proposals')?> <span class="red">+<?= Html::encode($ticket['proposal_count']) ?></span>
    </a>
</li>