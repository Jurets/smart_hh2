<?php

use kartik\widgets\StarRating;
use common\models\Offer;
use common\components\Commonhelper;

?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->params['GoogleAPI'] ?>&sensor=SET_TO_TRUE_OR_FALSE"
type="text/javascript"></script>
<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$this->registerJsFile(Yii::$app->params['path.js'] . 'performer_ticket_management.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>
<?php
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$isOwnTicket = $model->user_id === Yii::$app->user->id;
?>
<div data-Stage="<?= $stage ?>"></div>
<div class="job-creator row">
    <!-- the pop-up --> 
    <div id="complain-form" class="pop-up pop-up-edit popup-align-center pop-up-hide">
        <a class="close" href="#">×</a>
        <p class="title"><?php echo Yii::t('app', 'Send Complain') ?></p>
        <?php echo $this->render('_complain_form', ['model' => $model, 'complain' => $complain]) ?>
    </div>
    <!-- additional popup may put here  --!>
    <?php
        if ($isOwnTicket) {
            $review_direct = TRUE;
        }else{
            $review_direct = FALSE;
        }
    ?>
    <?=
    $this->render('popup/_set-as-done', [
        'model' => new common\models\Review(),
        'ticket' => $model,
        'review_direct' => $review_direct,
    ])
    ?>
    <!-- -->
    <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
        <h1><?= $model->title ?></h1>  


        <span class="date-time">
            Created <?= Commonhelper::convertDate($model->created) ?>
        </span>
        <?=$this->render('view/_deadline', ['model'=>$model])?>
        <div class="job-info-holder row">
            <div class="job-info col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <div class="job-price left">
                    <p class="price">&dollar;<?= $price ?></p>
                    <p>&nbsp;</p>
                </div>
                <div class="auction">
                    <?php if (!empty($newPrice)): ?>
                        <?= $newPrice['message'] ?>:<br/><span class="red">&dollar;<?= is_null($newPrice['price']) ? 0 : $newPrice['price'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="action col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <?php if ((!$applied) && (is_null($stage) || ($stage >= Offer::STAGE_OWNER_OFFER && $stage <= Offer::STAGE_LAST_ANSWER))) { ?>
                    <?= Html::beginForm(['ticket/apply'], 'post', ['style' => 'display:inline;']) ?>
                    <input type="hidden" name="ticket_id" value="<?= $model->id ?>" />
                    <a href="#" id="apply_button" class="btn btn-average" data-need-price="<?= ($price === null || $price <= 0) ? '1' : '0' ?>"><?=Yii::t('app', "APPLY")?></a>
                    <?= Html::endForm() ?>
                <?php } ?>
                <?php if ($model->canAcceptOffer() && $stage === Offer::STAGE_COUNTEROFFER) { ?>
                    <?= Html::beginForm(['ticket/performer-accept-offer'], 'post', ['style' => 'display:inline;']) ?>
                    <input type="hidden" name="ticket_id" value="<?= $model->id ?>" />
                    <?= Html::hiddenInput('price', $offers_price) ?>
                    <a href="#" id="accept_offer_button" class="btn btn-average"><?=Yii::t('app', "ACCEPT")?></a>
                    <?= Html::endForm() ?>
                <?php } ?>
                <?php if ($model->canAcceptOffer() && ((!$applied) || ((!is_null($stage)) && ($stage < Offer::STAGE_LAST_ANSWER)))) { ?>
                    <a href="#" style="text-transform:uppercase;" id="offer_button" class="btn btn-average"><?=Yii::t('app', "Offer Price")?></a>
                    <?= $this->render('popup/_offer-price', ['model' => $model]) ?>
                <?php } ?>
            </div>
        </div>
        <?php if ($model->photo !== null): ?>
            <div>
                <?=
                Html::img(Yii::$app->params['upload.url'] . '/' . $model->photo, [
                    'width' => 581,
                ])
                ?>
            </div>
        <?php endif; ?>
        <div class="description">
            <p class="title"><?=Yii::t('app', "Description")?>:</p> <a href="#" class="translate right">Перевести на руссский</a>
            <?= nl2br(\yii\helpers\HtmlPurifier::process($model->description)) ?>
            <a href="#" class="more"><?=Yii::t('app', "Read full description")?></a>                                 
        </div>
        <div class="location">
            <?php if ($model->job_location !== null): ?>
                <p class="title"><?=Yii::t('app', 'Write a Comment')?>: <?= Html::encode($model->job_location) ?></p>
            <?php endif; ?>

            <?php if (!is_null($model->lat) && !is_null($model->lon)) { ?>
                <div id="GoogleLat" style="display:none;"><?= $model->lat ?> </div>
                <div id="GoogleLng"style="display:none;"><?= $model->lon ?> </div>
                <div class="map ">
                    <div id="map_canvas" style="width:581px;height:352px;"></div>
                </div>
            <?php } else { ?>
                <div class="map"><?=Yii::t('app','no map')?></div>
            <?php } ?>
        </div>
        <?= $this->render('review/_comments', ['model' => $model]) ?>
    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">

        <div class="action-reply">
            <?php
            if (
                    ($isOwnTicket || ($model->performer_id === Yii::$app->user->id && $model->status !== common\models\Ticket::STATUS_DONE_BY_PERFORMER)) && $model->status !== common\models\Ticket::STATUS_COMPLETED) {
                ?>
                <?= Html::beginForm(['ticket/set-as-done'], 'post', ['style' => 'display:inline;']) ?>
                <?= Html::hiddenInput('ticket_id', $model->id); ?>
                <a href="#" class="btn btn-average" id="set_as_done" data-is-own-ticket="<?= $isOwnTicket ? '1' : '0' ?>"><?=Yii::t('app',"Set As Done")?></a>
                <?= Html::endForm() ?>
<?php } ?>
            <a href="#" id="complain-report" class="btn btn-average btn-report"><?=Yii::t('app', 'REPORT')?></a>
        </div>        
        <p class="title"><?=Yii::t('app', "Job creator")?>:</p>
        <div class="widget creator">
<?php $avatar = $user->profile->files ?>
            <a href="#"><img class="avatar left" alt="avatar" src="<?= (!is_null($avatar)) ? Yii::$app->params['upload.url'] . '/' . $avatar->code : '' ?>" /></a>

            <a href="<?= Url::to(['user/profile', 'id' => $user->id], true) ?>" class="name-creator">
                <?php
//                if (is_null($user->profile->first_name) || is_null($user->profile->last_name)) {
//                    echo $user->profile->full_name;
//                } else {
//                    echo $user->profile->first_name . ' ' . $user->profile->last_name;
//                }
                    echo Commonhelper::displayUserName($user->profile);
                ?>
            </a>
            <p class="active-jobs">Active&nbsp;
                <a href="#" class="number-jobs">
                   <?php
                        $activeJobs = Commonhelper::activeJobsCounter($user->id);
                   ?> 
                    <?=$activeJobs?>
                    <?php echo ($activeJobs > 1) ? Yii::t('app', 'jobs') : Yii::t('app', 'job');?>
                </a>
            </p>
        </div>
        <h6><span class="red"><?=$user->profile->voice?></span> <?=Yii::t('app', 'Opinions')?></h6>
        <div class="mark-creator">
            <!--<img src="/images/star5.png"><span class="vote">(3.5 based on 40 votes)</span>-->
            <?php
            $basedOn = Yii::t('app', "based on").' ';
            $votes = ' '.Yii::t('app', "votes");
            echo StarRating::widget([
                'id' => 'the-star-rating',
                'name' => 'noname',
                'value' => (is_null($user->profile->rating)) ? 0 : $user->profile->rating,
                'pluginOptions' => [
                    'readonly' => true,
                    'size' => '',
                    'showClear' => FALSE,
                    'showCaption' => true,
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'clearCaption' => '(0 '.$basedOn.' 0'.$votes.')',
                    'clearCaptionClass' => 'stars_rating_patch',
                    'starCaptions' => [
                        1 => '(1 '.$basedOn . $user->profile->voice . $votes,
                        2 => '(2 '.$basedOn . $user->profile->voice . $votes,
                        3 => '(3 '.$basedOn . $user->profile->voice . $votes,
                        4 => '(4 '.$basedOn . $user->profile->voice . $votes,
                        5 => '(5 '.$basedOn . $user->profile->voice . $votes,
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

        </div>

<!--        <div class="reviews-holder">
            <div class="reviews-item row">
                <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <a href="#"><img class="avatar left" src="/images/avatar-user.png" alt="avatar"/></a>
                    <div><a href="#" class="user-name">Alex B.</a>                                           
                        <div class="date-time">
                            JAN 1, 2015 15:15
                        </div>
                    </div> 
                </div>
                <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                    <a href="#" class="more">Read full description</a> 
                </div>
            </div>  
            <div class="reviews-item row">
                <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <a href="#"><img class="avatar left" src="/images/avatar-user.png" alt="avatar"/></a>
                    <div><a href="#" class="user-name">Alex B.</a>                                           
                        <div class="date-time">
                            JAN 1, 2015 15:15
                        </div>
                    </div> 
                </div>
                <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                    <a href="#" class="more">Read full description</a> 
                </div>
            </div> 
            <div class="reviews-item row">
                <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <a href="#"><img class="avatar left" src="/images/avatar-user.png" alt="avatar"/></a>
                    <div><a href="#" class="user-name">Alex B.</a>                                           
                        <div class="date-time">
                            JAN 1, 2015 15:15
                        </div>
                    </div> 
                </div>
                <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                    <a href="#" class="more">Read full description</a> 
                </div>
            </div> 
            <div class="reviews-item row">
                <div class="left col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <a href="#"><img class="avatar left" src="/images/avatar-user.png" alt="avatar"/></a>
                    <div><a href="#" class="user-name">Alex B.</a>                                           
                        <div class="date-time">
                            JAN 1, 2015 15:15
                        </div>
                    </div> 
                </div>
                <div class="text-right right col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                    <a href="#" class="more">Read full description</a> 
                </div>
            </div> 

            <a class="btn btn-width">SHOW MORE</a>       
        </div> -->
<?php echo $this->render('review_opinion', ['reviewOpinionDataProvider'=>$reviewOpinionDataProvider]) ?>

    </div> 
    <div class="clearfix"></div> 
</div>
<?php $similarTasks = $model->getSimilarTasks() ?>
<?php if (count($similarTasks)): ?>
    <?=
    \frontend\widgets\TwoColumnTasks::widget([
        'caption' => Yii::t('app', 'Similar Tasks'),
        'tasks' => $similarTasks,
        'moreButtonText' => Yii::t('app', 'SHOW MORE'),
        'moreButtonLink' => Url::to(['ticket/index', 'cid' => $model->category->id])
    ])
    ?>
<?php endif; ?>
