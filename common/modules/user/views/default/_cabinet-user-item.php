<?php
use kartik\widgets\StarRating;
?>
<div class="user-item">
    <div class="left user-item-info">
        <div class="profile-avatar left">
            <?php $photo = (!empty($profile->files->code)) ? Yii::$app->params['upload.url'] . '/' . $profile->files->code : Yii::$app->params['images.url'] . DIRECTORY_SEPARATOR . 'photo_cap.png' ?>
            <img class="avatar" src="<?= $photo ?>" alt="avatar">
            <a href="#" data-sign="PhotoUploads" class="btn btn-average change-photo">CHANGE PHOTO</a>
        </div>
        <div>
            <span class="user-name">
                <?php
                echo (!is_null($profile->first_name) && !is_null($profile->last_name)) ? $profile->first_name . ' ' . $profile->last_name : $profile->user->username;
                ?>
            </span>                                            
            <a href="#" class="user-status"><img src="/images/icon-facebook.png" alt=""/><span><img src="/images/icon-on.png" alt="on"/></span></a>
            <a href="#" class="user-status"><img src="/images/icon-in.png" alt=""/><span><img src="/images/icon-on.png" alt="on"/></span></a>
            <a href="#" class="user-status"><img src="/images/icon-tel.png" alt=""/><span><img src="/images/icon-on.png" alt="on"/></span></a>
            <a href="#" class="user-status"><img src="/images/icon-phone.png" alt=""/><span><img src="/images/icon-on.png" alt="on"/></span></a>
        </div>
        <p class="user-mark">
            <?php
            echo StarRating::widget([
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
                    'clearCaption' => '(0 based on 5 votes)',
                    'clearCaptionClass' => 'stars_rating_patch',
                    'starCaptions' => [
                        1 => '(1 based on 5 votes)',
                        2 => '(2 based on 5 votes)',
                        3 => '(3 based on 5 votes)',
                        4 => '(4 based on 5 votes)',
                        5 => '(5 based on 5 votes)',
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
        <span class="measurement">Hourly Rate:</span>
        <?php $hourlyRate = (!empty($profile->hourly_rate)) ? $profile->hourly_rate : 0 ?>
        <span class="price">&dollar;<?= $hourlyRate ?> and up</span><a href="#" class="edit"><span class="glyphicon glyphicon-pencil" data-sign="HourlyRate" aria-hidden="true"></span></a>
        <div class="pop-up-wrapper"><!-- pop up rendered here --> </div>

    </div>
    <div class="clear"></div>
</div>