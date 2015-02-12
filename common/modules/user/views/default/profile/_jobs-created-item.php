<?php
use yii\helpers\Url;
?>
<div class="task-item info-border">
    <div class="task-info-price">
        <p class="price">&dollar;<span><?= empty($model->price) ? '...' : $model->price?></span></p>
        <p class="measurement">week</p>
    </div>
    <div class="task-info-meta">
        <a  href="<?php echo Url::to(['/ticket/review', 'id' => $model->id]) ?>" class="title" data-pjax="0"><?= $model->title ?></a>
        <p class="text"><?= $model->description ?></p>
    </div>
    <div class="clearfix"></div>
    <div class="date-time right">
        <?= $model->finish_day ?> <br/>      
        Moscow, RU
    </div>
    <div class="clearfix"></div>
</div>