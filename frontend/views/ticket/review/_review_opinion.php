<?php
use yii\helpers\Url;
use kartik\rating\StarRating;
use common\components\Commonhelper;
?>
<div class="reviews-item row">
        <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
            <a href="#">
                <img class="avatar left" src="<?=Yii::$app->params['upload.url'].'/'.$model->fromUser->profile->files->code?>" alt="avatar">
            </a>
            <?php
//            $usernameThrow = (is_null($model->fromUser->profile->first_name) || is_null($model->fromUser->profile->last_name )) ? 
//                      $model->fromUser->username : 
//                      $model->fromUser->profile->first_name . ' '.$model->fromUser->profile->last_name
            $usernameThrow = Commonhelper::displayUserName($model->fromUser->profile);
            ?>
            <div><a href="<?=url::to(['user/profile', 'id'=>$model->fromUser->id])?>" class="user-name"><?=$usernameThrow?></a>                                           
                <div class="date-time" style="width:200px;">
                    <?=Commonhelper::convertDate($model->date)?>
                </div>
            </div> 
        </div>
        <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">

            <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="<?=Url::to(['ticket/review','id'=>$model->ticket_id])?>" class="red"><?=$model->ticket->title?></a>" task</p>
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
                    //'ratingClass' => 'WHEREISITAAAAAAA',
                ],
            ]);  
            ?>
            </p>

        </div>
        <div class="clearfix"></div>
        <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?=$model->message?>
            <a href="#" class="more">Read full description</a> 
        </div>
    </div>  
