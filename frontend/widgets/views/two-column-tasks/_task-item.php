<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="task-item">
    <div class="task-info-price" id="apply-block-<?=$model->id?>">
        <p class="price">&dollar;<span><?= \frontend\helpers\PriceHelper::truncate($model->price) ?></span></p>
        <p class="measurement">week</p>
        <a href="#" class="btn-small" data-apply_id="<?= $model->id ?>"><?= Yii::t('app', 'APPLY') ?></a>
        <div class="pos-relativer">
            <div class="popup-apply pop-up-hide">
                <div class="popup-apply-header">x</div>
                <div class="popup-apply-content"><!-- render apply form --></div>
            </div>
        </div>
    </div>
    <div class="task-info-meta">
        <a  href="<?php echo Url::to(['ticket/review', 'id' => $model->id]) ?>" class="title"><?= Html::encode($model->title) ?></a>
        <p class="date-time"><?= $model->created ?></p>
        <p class="text"><?= Html::encode($model->description) ?></p>
    </div>
    <div class="clear"></div>
</div>

<div data-renderLoginForm="<?=URL::to(['/ticket/renderloginform'])?>"></div>
<div data-renderApplyForm="<?=URL::to(['/ticket/renderapplyform'])?>"></div>
<div data-loginFormURLAction="<?=Url::to(['/user/login'])?>"></div>