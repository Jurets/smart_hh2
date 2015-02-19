<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<li>
    <a href="<?= Url::to(['/ticket/view', 'id' => $ticket['id']]) ?>">
        <?= Html::encode($ticket['date'])?>:
        <?= Html::encode($ticket['username']) ?> <?= Yii::t('app','offered new price for job')?> "<?= Html::encode($ticket['title']) ?>": <span class="red">$<?= Html::encode($ticket['price']) ?></span>
    </a>
</li>