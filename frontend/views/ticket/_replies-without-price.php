<?php
use kartik\rating\StarRating;
use yii\helpers\Html;
/*@var $model \common\models\Ticket*/
/*@var $propose \common\models\Reply*/
$this->registerJsFile(Yii::$app->params['path.js'].'customer_ticket_management.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>
<div class="reviews-item row">
    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <?php $avatar = $propose->performer->profile->files?>
        <img class="avatar left" src="<?=is_null($avatar) ? '' : Yii::$app->params['upload.url'].'/'.$avatar->code?>" alt="avatar">
        <div><span class="user-name"><?php echo $propose->performer->username ?></span>                                           
            <div class="date-time">
                <?php echo $propose->date?>
            </div>
        </div> 
    </div>
    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
        <p class="user-mark"><span>Rated: </span>
            <?php
              echo StarRating::widget([
                'id' => 'the-star-rating'.$propose->performer->id,
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
        <p>Completed <span class="number-jobs"><?=$propose->performer->profile->done_tasks?> jobs</span></p>
    </div>
    <div class="clearfix"></div>
    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p class="red"><?php echo $propose->performer->username?> offered a price: $<?php echo $propose->price?></p>
        <?php
            $userFirstName = $propose->ticket->user->profile->first_name;
            $treatment = Yii::t('app', 'Hey') . ' ';
            $treatment .=  is_null($userFirstName) ? $propose->ticket->user->username : $userFirstName;
            $treatment .= ', '. $propose->message .'!';
            echo $treatment;
        ?> 
        <div class="comment-action">
            <?= Html::beginForm(['ticket/accept-offer'],'post',['style' => 'display:inline']) ?>
                <?= Html::hiddenInput('ticket_id', $model->id) ?>
                <?= Html::hiddenInput('performer_id', $propose->performer_id) ?>
                <?= Html::hiddenInput('price', $propose->price) ?>
                <a href="#" class="btn btn-average accept-offer">ACCEPT</a>
            <?= Html::endForm() ?>
            <a href="#" class="btn btn-average btn-dark">MAKE ANOTHER OFFER</a>
        </div>
    </div>
</div> 