<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\StarRating;
use frontend\helpers\ContactsHelper;
use common\components\Commonhelper;
?>

<?php
$breadcrumb_title = Yii::t('app', 'Profile');
$this->title = $breadcrumb_title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'All Users'),
    'url' => Url::to(['/user']),
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-profile row">
    <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
        <div class="user-item  info-border">
            <div class="left user-item-info">
<?php if (empty($photos) === TRUE) {
    $photo = '/images/photo_cap.png';
} else {
    $photo = Yii::$app->params['upload.url'] . '/' . $photos[0]->code;
} ?>
                <img class="avatar left" src="<?php echo $photo ?>" alt="avatar">
                <div><span class="user-name">
                        <?php //echo Html::encode(ContactsHelper::getFullName($profile)) ?>
                        <?php echo html::encode(Commonhelper::displayUserName($profile)) ?>
                    </span>                                            
                            <?php foreach ($profile->user->userSocialNetworks as $userSocialNetwork): ?>
                        <a href="#" class="user-status">
                            
                            <?php if ($userSocialNetwork->moderate):  ?>
                            
                            <?php echo Html::img(Yii::$app->params['images.url'] . '/' . $userSocialNetwork->socialNetwork->icon, ['alt' => $userSocialNetwork->socialNetwork->title]) ?>
                        <?php //if ($userSocialNetwork->moderate): //пока поднимаю наверх ?>
                                <span>
        <?= Html::img(Yii::$app->params['images.url'] . '/icon-on.png', ['alt' => 'on']) ?>
                                </span>
    <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <p class="user-mark">
<!--                    <img src="/images/star5.png" alt=""/>
                    <span class="vote">(3.5 based on 40 votes)</span>-->
                    <?php
                    $basedOn = Yii::t("app", "based on");
                    $votes = Yii::t('app', 'votes');
                    echo StarRating::widget([
                        'id' => 'the-star-rating-' . $profile->id,
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
                            'clearCaption' => '(0 '.$basedOn.' 0 '.$votes. ')',
                            'clearCaptionClass' => 'stars_rating_patch',
                            'starCaptions' => [
                                1 => '(1 '.$basedOn.' '.$profile->voice .' '.$votes.')',
                                2 => '(2 '.$basedOn.' '.$profile->voice .' '.$votes.')',
                                3 => '(3 '.$basedOn.' '.$profile->voice .' '.$votes.')',
                                4 => '(4 '.$basedOn.' '.$profile->voice .' '.$votes.')',
                                5 => '(5 '.$basedOn.' '.$profile->voice .' '.$votes.')',
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
                <p class="user-info">
                    <img src="/images/language-icon.png" alt=""/><span class="info-position">United States</span>
                    <a href="#"  class="info-position color-done"><span class="red">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span>
                            <?php echo $profile->created_tasks ?>&nbsp;<?=Yii::t('app',"Done Tasks")?>
                            </span>
                    </a>
                    <a href="#"  class="info-position  color-create"><span class="purple"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
                            </span> 
<?= $profile->done_tasks ?>&nbsp; <?=Yii::t('app',"tasks create")?>
                        </span></a>
                </p>
<?php if ($profile->user_id === Yii::$app->user->id) { ?>
    <?= $this->render('profile/_withdraw_popup', ['paymentProfile'=>$paymentProfile, 'profile'=>$profile]); ?>
    <?= $this->render('profile/_money_output', ['profile' => $profile]); ?>
<?php } else { ?>
                    <a href="#" class="user-additional-info" style="font-size:12px;"><?php echo $activityMessage ?></a>
<?php } ?>
                <a href="#"  class="user-additional-info" style="font-size:12px;"><?php echo $doneTaskMessage ?></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
        <div class="row">
            <div class="user-info-prise-wrapper col-xs-6 col-sm-4 col-md-4 col-lg-6">
                <div class="user-info-price">
                    
                    <div data-locker="just-lock" style="display:none;">
                    <span class="measurement">Hourly Rate</span><br/>
                    <span class="price">&dollar;<?= is_null($profile->hourly_rate) ? 0 : $profile->hourly_rate ?> and up</span>
                    </div>
                    <div><br><br></div>
                    <a href="#" class="btn btn-width offer-job-button"
                       style="font-size: 13px;"
                       data-user-id="<?= $profile->user_id ?>"
                       data-url="<?= Url::to(['/user/default/get-offer-job-popup']) ?>">
                        <?=Yii::t('app', "OFFER A JOB")?>
                    </a>
                </div>
                <div id="offer-job-pop-up-container">
                </div>
            </div>
            <div class="user-contact col-xs-6 col-sm-4 col-md-4 col-lg-6">
<?php if (!empty($languages)): ?>
        <p class="title"><?=Yii::t('app', "Languages")?>:</p>
        <?php
            foreach ($languages as $language) {
        ?>
        <p style="font-weight: <?= empty($language['is_native']) ? 'normal' : 'bold'; ?>">
            <?=Html::encode($language['full_name']); ?>
        </p>
        <?php
            }
        ?>
<?php endif; ?>
                <p class="title"><?=yii::t('app', "Verified Contacts")?>:</p>
                <p class=""><?= Html::encode(ContactsHelper::getEmail($profile->user, $canViewContacts)) ?></p>
                <p class=""><img src="" alt="" />
<?php if (!empty($profile->phone)): ?>
                        +<?= Html::encode($profile->country_code) ?> <?= Html::encode(ContactsHelper::getPhone($profile, $canViewContacts)) ?>
<?php endif; ?>
                </p>
            </div>
        </div>  
    </div>   

</div>
<div class="row">
        <?=
        $this->render('profile/_your-jobs', [
            'jobsCreatedDataProvider' => $jobsCreatedDataProvider,
            'jobsAppliedDataProvider' => $jobsAppliedDataProvider,
            'jobsDonedDataProvider' => $jobsDonedDataProvider,
        ])
        ?>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
    <?= $this->render('_profile_spec', ['profile' => $profile, 'userSpecialities' => $userSpecialities]) ?>
    <?= $this->render('_profile_diploma', ['diplomas' => $diplomas]) ?>
    </div> 
<?=
$this->render('profile/_reviews', [
    'positiveReviewDataProvider' => $positiveReviewDataProvider,
    'negativeReviewDataProvider' => $negativeReviewDataProvider,
])
?>
</div>       





<div class="clear"></div>
