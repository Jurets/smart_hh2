<?php
/*@var $model common\models\TicketComments*/
?>
<div class="reviews-item row <?= is_null($model->answer_to) ? '' : 'answer' ?>">
    <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
        <a href="#"><img class="avatar left" src="
            <?=(!is_null($model->user->profile->files)) ? Yii::$app->params['upload.url'] . '/' . $model->user->profile->files->code : '' ?>" alt="avatar"/></a>
        <div><a href="#" class="user-name"><?= $model->user->profile->full_name?></a>                                           
            <div class="date-time">
                <?= $model->date ?>
            </div>
        </div> 
    </div>
    <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">
    </div>
    <div class="clearfix"></div>
    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?= yii\helpers\Html::encode($model->text) ?>
    </div>
</div>