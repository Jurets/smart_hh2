<?php
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Commonhelper;
/*@var $model \common\models\Ticket*/
/*@var $propose \common\models\Reply*/
?>
<div class="reviews-item row">
    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <?php $avatar = $propose->performer->profile->files?>
        <img class="avatar left" src="<?=is_null($avatar) ? '' : Yii::$app->params['upload.url'].'/'.$avatar->code?>" alt="avatar">
        <div>
            
            <a href="<?=Url::to(['user/profile','id'=>$propose->performer_id],true)?>">
                <span class="user-name"><?php /*echo $propose->performer->username*/ echo Commonhelper::displayUserName($propose->performer->profile) ?></span>
            </a>
            
            <div class="date-time">
                <?php /*echo $propose->date */ echo Commonhelper::convertDate($propose->date)?>
            </div>
        </div> 
    </div>
    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
        <p class="user-mark"><span><?=Yii::t('app', "Rated")?>: </span>
            <?php
            $basedOn = Yii::t('app', "based on").' ';
            $votes = ' '.Yii::t('app', "votes");
              echo StarRating::widget([
                //'id' => 'the-star-rating'.$propose->performer->id,
                'name' => 'noname',
                'value' => (is_null($propose->performer->profile->rating)) ? 0 : $propose->performer->profile->rating,
                'pluginOptions' => [
                    'readonly' => true,
                    'size' => '',
                    'showClear' => FALSE,
                    'showCaption' => true,
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'clearCaption' => '(0 '.$basedOn. '0' . $votes. ')',
                    'clearCaptionClass' => 'stars_rating_patch',
                    'starCaptions' => [
                        1 => '(1 '.$basedOn.$propose->performer->profile->voice.$votes,
                        2 => '(2 '.$basedOn.$propose->performer->profile->voice.$votes,
                        3 => '(3 '.$basedOn.$propose->performer->profile->voice.$votes,
                        4 => '(4 '.$basedOn.$propose->performer->profile->voice.$votes,
                        5 => '(5 '.$basedOn.$propose->performer->profile->voice.$votes,
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
        <p><?=Yii::t('app', "Completed")?> <span class="number-jobs"><?=$propose->performer->profile->done_tasks?><?=' '.Yii::t('app', "jobs")?></span></p>
    </div>
    <div class="clearfix"></div>
    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p class="red"><?php echo $propose->performer->username?> <?=' '.Yii::t('app', "offered a price")?>: $<?php echo $propose->price?></p>
        <?php
            $userFirstName = $propose->ticket->user->profile->first_name;
            $treatment = Yii::t('app', 'Hey') . ' ';
            $treatment .=  is_null($userFirstName) ? $propose->ticket->user->username : $userFirstName;
            $treatment .= ', '. Yii::t('app', $propose->message) .'!';
            echo $treatment;
        ?> 
        <div class="comment-action">
            <?php if($model->canAcceptOffer()): ?>
            <?= Html::beginForm(['ticket/accept-offer'],'post',['style' => 'display:inline']) ?>
                <?= Html::hiddenInput('ticket_id', $model->id) ?>
                <?= Html::hiddenInput('performer_id', $propose->performer_id) ?>
                <?= Html::hiddenInput('price', isset($propose->priceFee) ? $propose->priceFee : 0) ?>
                <a href="#" class="btn btn-average accept-offer"
                   data-ticket-id="<?= $model->id ?>"
                   data-performer-id="<?= $propose->performer_id ?>"
                   data-price="<?= $propose->price ?>"
                   data-url="<?= \yii\helpers\Url::to(['/ticket/render-paypal-popup'])?>"><?=Yii::t('app', "ACCEPT")?></a>
            <?= Html::endForm() ?>
                <?php if($propose->canOfferPrice()): ?>
                    <a href="#" class="btn btn-average btn-dark make-another-offer" data-performer-id="<?= $propose->performer_id ?>"><?=Yii::t('app', "MAKE ANOTHER OFFER")?></a>
                <?php endif; ?>
            <?php endif;?>
        </div>
    </div>
</div> 