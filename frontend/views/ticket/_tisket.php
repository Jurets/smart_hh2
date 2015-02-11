<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
//$this->registerJsFile(Url::to(['/js/ticket_apply.js']), [
$this->registerJsFile(Yii::$app->params['path.js'].'ticket_apply.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>

<div class="task-item info-border">
    <div class="task-info-price" id="apply-block-<?=$model->id?>">
        <p class="price">&dollar;<span id="digital_price_part"><?= empty($model->price) ? '...' : $model->price?></span></p>
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
        <a  href="<?php echo Url::to(['ticket/review', 'id' => $model->id]) ?>" class="title"><?= $model->title ?></a>
        <p class="text"><?= $model->description ?></p>
    </div>
    <div class="clearfix"></div>
    <div class="autor left">
<?php $photo = $model->user->profile->files; ?>
        <img class="left" style="width:45px;" src="<?php echo (!is_null($photo)) ? Yii::$app->params['upload.url'] . '/' . $model->user->profile->files->code : '' ?>" alt="avatar">
        <p>Alex B.<img src="/images/star5.png"/><span class="vote">(3.5 based on 40 votes)</span></p>
        <p>Active 35 jobs</p>
    </div>
    <div class="date-time right">
<?= $model->finish_day ?> <br/>      
        Moscow, RU
    </div>
    <div class="clearfix"></div>
</div>


<div data-renderLoginForm="<?=URL::to(['renderloginform'])?>"></div>
<div data-renderApplyForm="<?=URL::to(['renderapplyform'])?>"></div>
<div data-loginFormURLAction="<?=Url::to(['/user/login'])?>"></div>