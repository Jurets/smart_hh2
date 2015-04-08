<?php
use yii\helpers\Html;
use kartik\widgets\StarRating;
use yii\helpers\Url;
?>
<div class="user-item info-border row">
    <div class="user-item-info col-xs-9 col-sm-9 col-md-9 col-lg-10">
        <?php $photo = $model->profile->files; ?>
        <a href="#"><img style="width:116px;" alt="avatar" src="<?php echo (!is_null($photo)) ? Yii::$app->params['upload.url'] . '/' . $photo->code : '' ?>" class="avatar left"></a>
        <div class="user-status-all">
            <a class="user-name" href="<?php echo Url::to(['/user/profile', 'id'=>$model->id],true) ?>"><?php echo $model->username ?> </a>                                           
            <?php foreach($model->userSocialNetworks as $userSocialNetwork):?>
                <a href="#" class="user-status">
                    <?php if($userSocialNetwork->moderate): // пока поднимаю вверх?>
                    <?= Html::img(Yii::$app->params['images.url'].'/'.$userSocialNetwork->socialNetwork->icon, ['alt' => $userSocialNetwork->socialNetwork->title]) ?>
                    <?php //if($userSocialNetwork->moderate): // пока поднимаю вверх?>
                        <span>
                            <?= Html::img(Yii::$app->params['images.url'].'/icon-on.png', ['alt' => 'on']) ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php
        echo StarRating::widget([
            'id' => 'the-star-rating-'.$model->id,
            'name' => 'noname',
            'value' => (is_null($model->profile->rating)) ? 0 : $model->profile->rating,
            'pluginOptions' => [
                'readonly' => true,
                'size' => '',
                'showClear' => FALSE,
                'showCaption' => true,
                'stars' => 5,
                'min' => 0,
                'max' => 5,
                'clearCaption' => '(0 based on 0 votes)',
                'clearCaptionClass' => 'stars_rating_patch',
                'starCaptions' => [
                    1 => '(1 based on '.$model->profile->voice.' votes)',
                    2 => '(2 based on '.$model->profile->voice.' votes)',
                    3 => '(3 based on '.$model->profile->voice.' votes)',
                    4 => '(4 based on '.$model->profile->voice.' votes)',
                    5 => '(5 based on '.$model->profile->voice.' votes)',
                ],
                'starCaptionClasses' => [
                    1 => 'stars_rating_patch',
                    2 => 'stars_rating_patch',
                    3 => 'stars_rating_patch',
                    4 => 'stars_rating_patch',
                    5 => 'stars_rating_patch',
                ],
            ],
        ]);
        ?>
        <p class="user-info">
            <span class="info-position"><img alt="" src="/images/language-icon.png">United States</span>
            <a class="info-position color-done" href="#"><span class="red"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span>
            <?=(is_null($model->profile->done_tasks))?0:$model->profile->done_tasks?> <?=Yii::t('app', 'tasks done')?>
                </span></a>
            <a class="info-position  color-create" href="#"><span class="purple"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span> 
                    <?= (is_null($model->profile->created_tasks)) ? 0 : $model->profile->created_tasks ?> <?=Yii::t('app', 'tasks create')?>
                </span></a>
        </p>
    </div>
    <div class="user-info-price col-xs-3 col-sm-3 col-md-3 col-lg-2">
        <p class="measurement"><?=Yii::t('app', 'Hourly Rate')?>:</p>
        <p class="price">$<?=(is_null($model->profile->hourly_rate))? 0 : $model->profile->hourly_rate?></p>
        <a class="btn btn-average offer-job-button" href="#"
           data-user-id="<?= $model->id ?>"
           data-url="<?= Url::to(['/user/default/get-offer-job-popup'])?>">
            OFFER A JOB
        </a>
    </div>                                
</div>