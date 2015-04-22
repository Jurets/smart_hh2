<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\rating\StarRating;
use common\components\Commonhelper;
?>
<?php /*@var $model \common\models\Review*/ ?>
<?php $avatar = $model->fromUser->profile->files?>
<div class="reviews-item row">
    <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="<?=Url::to(['/user/default/profile', 'id' => $model->from_user_id])?>">
            <img class="avatar left" src="<?=is_null($avatar) ? '' : Yii::$app->params['upload.url'].'/'.$avatar->code?>" alt="avatar"/>
        </a>
        <a href="<?=Url::to(['/user/default/profile', 'id' => $model->from_user_id])?>" class="user-name">
            <?php /* echo Html::encode($model->fromUser->username )*/ echo Html::encode( Commonhelper::displayUserName($model->fromUser->profile) ) ?>
        </a>                                           
        <div class="date-time">
            <?= Commonhelper::convertDate($model->date) ?>
        </div>

    </div>
    <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <?php if($model->ticket_id !== null && $model->ticket !== null): ?>
            <p class="task-title"><img src="/images/icon-task.png" alt=""/>
                To "<a href="<?=Url::to(['/ticket/review', 'id' => $model->ticket_id])?>" class="red"><?= Html::encode($model->ticket->title) ?></a>" task
            </p>
        <?php endif; ?>
        <p class="user-mark"><span>Rated:</span>
            <?= StarRating::widget([
                'id' => 'review-star-rating-'.$model->id,
                'name' => '',
                'value' => (is_null($model->rating)) ? 0 : $model->rating,
                'pluginOptions' => [
                    'readonly' => true,
                    'size' => '',
                    'showClear' => false,
                    'showCaption' => false,
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'ratingClass' => 'WHEREISITAAAAAAA',
                ],
            ]);  
            ?>
        </p>

    </div>
    <div class="clearfix"></div>
    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?= Html::encode($model->message)?>
    </div>
</div> 