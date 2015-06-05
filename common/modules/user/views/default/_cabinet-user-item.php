<?php
use yii\helpers\Html;
use kartik\widgets\StarRating;
use common\components\Commonhelper;
?>
<div class="user-item">
    <div class="left user-item-info">
        <div class="profile-avatar left">
            <?php $photo = (!empty($profile->files->code)) ? Yii::$app->params['upload.url'] . '/' . $profile->files->code : Yii::$app->params['images.url'] . DIRECTORY_SEPARATOR . 'photo_cap.png' ?>
            <img class="avatar" src="<?= $photo ?>" alt="avatar">
            <a href="#" data-sign="PhotoUploads" class="btn btn-average change-photo"><?=Yii::t('app',"CHANGE PHOTO")?></a>
        </div>
        <div>
            <span class="user-name">
                <?php
               // echo (!is_null($profile->first_name) && !is_null($profile->last_name)) ? $profile->first_name . ' ' . $profile->last_name : $profile->user->username;
                echo Commonhelper::displayUserName($profile);
                ?>
            </span>                                            
            <?php foreach($profile->user->userSocialNetworks as $userSocialNetwork):?>
                <a href="#" class="user-status">
                    <?= Html::img(Yii::$app->params['images.url'].'/'.$userSocialNetwork->socialNetwork->icon, ['alt' => $userSocialNetwork->socialNetwork->title]) ?>
                    <?php if($userSocialNetwork->moderate): ?>
                        <span>
                            <?= Html::img(Yii::$app->params['images.url'].'/icon-on.png', ['alt' => 'on']) ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <p class="user-mark">
            <?php
            $basedOn = Yii::t('app', 'based on');
            $votes = Yii::t('app','votes');
                    echo StarRating::widget([
                        'id' => 'the-star-rating',
                        'name' => 'noname',
                        'value' => (is_null($profile->rating)) ? 0 : $profile->rating,
                        'pluginOptions' => [
                            'readonly' => true,
                            'size' => '',
                            'showClear' => FALSE,
                            'showCaption' => true,
                            'stars' => 5,
                            'min' => 0,
                            'max' => 5,
                            'clearCaption' => "(0 $basedOn 0 $votes)",
                            'clearCaptionClass' => 'stars_rating_patch',
                            'starCaptions' => [
                                1 => "(1 $basedOn ".$profile->voice." $votes)",
                                2 => "(2 $basedOn ".$profile->voice." $votes)",
                                3 => "(3 $basedOn ".$profile->voice." $votes)",
                                4 => "(4 $basedOn ".$profile->voice." $votes)",
                                5 => "(5 $basedOn ".$profile->voice." $votes)",
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
        </p>
        <img src="/images/language-icon.png" alt=""/><span class="info-position">United States</span><a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a><br/>
        
        <div data-locker="just hide this" style="display:none;">
        <span class="measurement">Hourly Rate:</span>
        <?php $hourlyRate = (!empty($profile->hourly_rate)) ? $profile->hourly_rate : 0 ?>
        <span class="price">&dollar;<?= $hourlyRate ?> and up</span><a href="#" class="edit"><span class="glyphicon glyphicon-pencil" data-sign="HourlyRate" aria-hidden="true"></span></a>
        </div>
        <div class="pop-up-wrapper"><!-- pop up rendered here --> </div>
        
    </div>
    <div class="clear"></div>
</div>
