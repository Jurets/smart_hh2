<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$this->registerJsFile(Yii::$app->params['path.js'].'ticket_apply.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>
<div class="task-item">
    <div class="task-info-price" id="apply-block-<?=$model->id?>">
        <p class="price">&dollar;<span><?= empty($model->price) ? '...' : $model->price?></span></p>
        <p class="measurement">week</p>
        <a href="#" class="btn-small" data-apply_id="<?= $model->id ?>"><?= Yii::t('app', 'APPLY') ?></a>
    </div>
    <div class="task-info-meta">
        <a  href="<?php echo Url::to(['ticket/review', 'id' => $model->id]) ?>" class="title"><?= Html::encode($model->title) ?></a>
        <p class="date-time"><?= $model->created ?></p>
        <p class="text"><?= Html::encode($model->description) ?></p>
    </div>
    <div class="clear"></div>
</div>

<div data-renderLoginForm="<?=URL::to(['renderloginform'])?>"></div>
<div data-renderApplyForm="<?=URL::to(['renderapplyform'])?>"></div>
<div data-loginFormURLAction="<?=Url::to(['/user/login'])?>"></div>