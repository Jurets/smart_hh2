<?php if($index === 0) {?>
<div class="table-row">
    <div class="table-cell"><?=Yii::t('app','Date')?></div>
    <div class="table-cell"><?=Yii::t('app','From')?></div>
    <div class="table-cell"><?=Yii::t('app','To')?></div>
    <div class="table-cell"><?=Yii::t('app','Ticket')?></div>
    <div class="table-cell">&dollar;</div>
</div>
<?php }?>
<div class="table-row">
    <div class="table-cell"><?=$model->date?></div>
    <div class="table-cell"><?=( is_null($model->fromUser->profile->first_name) || is_null($model->fromUser->profile->last_name)) ? $model->fromUser->username : $model->fromUser->profile->first_name.' '.$model->fromUser->profile->last_name?></div>
    <div class="table-cell"><?=( is_null($model->toUser->profile->first_name) || is_null($model->toUser->profile->last_name)) ? $model->toUser->username : $model->toUser->profile->first_name.' '.$model->toUser->profile->last_name?></div>
    <div class="table-cell"><?=$model->details0->title?></div>
    <div class="table-cell"><?=$model->amount?></div>
</div>