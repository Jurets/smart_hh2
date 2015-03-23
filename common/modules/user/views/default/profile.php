<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\StarRating;
use frontend\helpers\ContactsHelper;
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
                <?php if(empty($photos)===TRUE){$photo='/images/photo_cap.png';}else{$photo=Yii::$app->params['upload.url'] . '/' . $photos[0]->code;} ?>
                <img class="avatar left" src="<?php echo $photo ?>" alt="avatar">
                <div><span class="user-name">
                    <?= Html::encode(ContactsHelper::getFullName($profile)) ?>
                    </span>                                            
                    <?php foreach ($profile->user->userSocialNetworks as $userSocialNetwork): ?>
                        <a href="#" class="user-status">
                            <?= Html::img(Yii::$app->params['images.url'] . '/' . $userSocialNetwork->socialNetwork->icon, ['alt' => $userSocialNetwork->socialNetwork->title]) ?>
                            <?php if ($userSocialNetwork->moderate): ?>
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
                    echo StarRating::widget([
                        'id' => 'the-star-rating-'.$profile->id,
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
                            'clearCaption' => '(0 based on 0 votes)',
                            'clearCaptionClass' => 'stars_rating_patch',
                            'starCaptions' => [
                                1 => '(1 based on '.$profile->voice.' votes)',
                                2 => '(2 based on '.$profile->voice.' votes)',
                                3 => '(3 based on '.$profile->voice.' votes)',
                                4 => '(4 based on '.$profile->voice.' votes)',
                                5 => '(5 based on '.$profile->voice.' votes)',
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
                               <?php echo $profile->created_tasks ?> done tasks
                            </span>
                    </a>
                    <a href="#"  class="info-position  color-create"><span class="purple"><span class="glyphicon glyphicon-pencil" aria-hidden="true">
                            </span> 
                            <?=$profile->done_tasks?> tasks created
                        </span></a>
                </p>
                <a href="#" class="user-additional-info"><?php echo $activityMessage ?></a>
                <a href="#"  class="user-additional-info">Latest task done 3 days ago</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
        <div class="row">
            <div class="user-info-prise-wrapper col-xs-6 col-sm-4 col-md-4 col-lg-6">
                <div class="user-info-price">
                    <span class="measurement">Hourly Rate</span><br/>
                    <span class="price">&dollar;<?=is_null($profile->hourly_rate) ? 0 : $profile->hourly_rate?> and up</span>
                    <a href="#" class="btn btn-width offer-job-button"
                       data-user-id="<?= $profile->user_id ?>"
                       data-url="<?= Url::to(['/user/default/get-offer-job-popup'])?>">
                        OFFER A JOB
                    </a>
                </div>
                <div id="offer-job-pop-up-container">
                </div>
            </div>
            <div class="user-contact col-xs-6 col-sm-4 col-md-4 col-lg-6">
                <?php $languages = ContactsHelper::getLanguages($profile->user); ?>
                <?php if(!empty($languages)): ?>
                    <p class="title">Languages:</p>
                    <p class=""><?= Html::encode($languages) ?></p>
                <?php endif; ?>
                <p class="title">Verified Contacts:</p>
                <p class=""><?= Html::encode(ContactsHelper::getEmail($profile->user, $canViewContacts)) ?></p>
                <p class=""><img src="" alt="" />
                    <?php if(!empty($profile->phone)):?>
                        +<?=  Html::encode($profile->country_code) ?> <?= Html::encode(ContactsHelper::getPhone($profile, $canViewContacts)) ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>  
    </div>   

</div>
<div class="row">
    <?= $this->render('profile/_your-jobs',[
        'jobsCreatedDataProvider' => $jobsCreatedDataProvider,
        'jobsAppliedDataProvider' => $jobsAppliedDataProvider,
            ]) ?>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
        <?=$this->render('_profile_spec',['profile'=>$profile,'userSpecialities'=>$userSpecialities])?>
        <?=$this->render('_profile_diploma',['diplomas' => $diplomas])?>
    </div> 
    <?=
    $this->render('profile/_reviews', [
        'positiveReviewDataProvider' => $positiveReviewDataProvider,
        'negativeReviewDataProvider' => $negativeReviewDataProvider,
    ])
    ?>
</div>       





<div class="clear"></div>
