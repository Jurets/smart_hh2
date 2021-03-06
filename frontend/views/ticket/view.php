<script src="https://maps.googleapis.com/maps/api/js?key=<?=Yii::$app->params['GoogleAPI']?>&sensor=SET_TO_TRUE_OR_FALSE"
  type="text/javascript"></script>
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Ticket;
use common\components\Commonhelper;
?>

<?php
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if($isAutoFocus){
    $this->registerJsFile(Yii::$app->params['path.js'].'view-reply-autofocus.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
}
$this->registerJsFile(Yii::$app->params['path.js'].'customer_ticket_management.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>

                    <div class="job-creator row">
                        <?php if($model->status === Ticket::STATUS_DONE_BY_PERFORMER): ?>
                        <div class="alert alert-danger"><?= Yii::t('app' , 'Performer claims this work as done') ?> 
                                    <a href="#" class="btn btn-average" id="set_as_done" data-is-own-ticket="1"><?= Yii::t('app', 'CONFIRM') ?></a>
                                    <a href="#" id="complain-report" class="btn btn-average btn-report"><?=Yii::t('app', "REPORT")?></a>
                        </div>
                        <?php endif; ?>
                        <div id="complain-form" class="pop-up pop-up-edit popup-align-center pop-up-hide">
                            <a class="close" href="#">×</a>
                            <p class="title"><?php echo Yii::t('app', 'Send Complain') ?></p>
                            <?php echo $this->render('_complain_form', ['model' => $model, 'complain' => $complain]) ?>
                        </div>
        <?=
        $this->render('popup/_set-as-done', [
            'model' => new common\models\Review(),
            'ticket' => $model
        ])
        ?>                        
                        <div id="paypal-popup" class="pop-up pop-up-edit popup-align-center pop-up-hide">
                            <a class="close" href="#">×</a>
                            <div class="popup-content"></div>
                        </div>
                        <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
                            <h1><?=$model->title?></h1>


                            <span class="date-time">
                                <?=Yii::t('app','Created')?> <?=Commonhelper::convertDate($model->created)?>
                            </span>
                            <?=$this->render('view/_deadline', ['model'=>$model])?>
                            <div class="job-info-holder row">
                                <div class="job-info col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="job-price left">
                                        <p class="price">$<?= is_null($model->price) ? 0 : $model->price?></p>
                                        <p class="measurement">&nbsp;</p>
                                    </div>
                               <!-- <div class="auction">
                                        Ready to raise on:<br/><span class="red">&dollar;1</span>
                                    </div>-->
                                </div>
                                <div class="action col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <!--<a href="<?php //echo Url::to(['ticket/delete', 'id'=>$model->id])?>" class="btn btn-delete btn-average">DELETE</a>-->
                                    <?php
                                       if($model->performer_id === null){
                                           echo Html::beginForm(Url::to(['ticket/delete']),'post', ['class'=>'left', 'style'=>'margin-right:20px;']);
                                           echo Html::submitButton(Yii::t('app', 'DELETE'), ['class'=>"btn btn-delete btn-average"]);
                                           echo Html::hiddenInput('id', $model->id);
                                           echo Html::endForm();
                                       }
                                    ?>
                                    <a href="<?=Url::to(['ticket/update', 'id'=>$model->id])?>" class="btn btn-average"><?=Yii::t('app','EDIT THIS JOB')?></a>
                                </div>

                            </div>
                            <?php if($model->photo !== null): ?>
                                <div>
                                    <?= Html::img(Yii::$app->params['upload.url'] . '/' . $model->photo,[
                                        'width' => 581,
                                    ])?>
                                </div>
                            <?php endif; ?>
                            <div class="description">
                                <p class="title"><?=Yii::t('app', 'Description')?>:</p>
                                <?= nl2br(\yii\helpers\HtmlPurifier::process($model->description)) ?>
                                <a href="#" class="more"><?=Yii::t('app', "Read full description")?></a>                                 
                            </div>
                            <div class="location">
                                <?php if($model->job_location !== null): ?>
                                <p class="title"><?=Yii::t('app', 'Job Location')?>: <?= Html::encode($model->job_location) ?></p>
                                <?php endif; ?>
                                
                                <?php if( !is_null($model->lat) && !is_null($model->lon) ) { ?>
                                <div id="GoogleLat" style="display:none;"><?=$model->lat?> </div>
                                <div id="GoogleLng"style="display:none;"><?=$model->lon?> </div>
                                <div class="map ">
                                    <div id="map_canvas" style="width:581px;height:352px;"></div>
                                </div>
                                <?php } else { ?>
                                <div class="map"><?=Yii::t('app','no map')?></div>
                                <?php } ?>
                            </div>
                            <?= $this->render('view/_comments', ['model' => $model]) ?>
                        </div>
                        <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
                            <?php if($model->status !== Ticket::STATUS_COMPLETED
                                    && $model->status !== Ticket::STATUS_DONE_BY_PERFORMER){ ?>
                            <div class="action-reply">
                                    <?= Html::beginForm(['ticket/set-as-done'], 'post', ['style' => 'display:inline;']) ?>
                                    <?= Html::hiddenInput('ticket_id', $model->id); ?>
                                    <a href="#" class="btn btn-average" id="set_as_done" data-is-own-ticket="1"><?=Yii::t('app',"Set As Done")?></a>
                                    <?= Html::endForm() ?>
                                    <a href="#" id="complain-report" class="btn btn-average btn-report"><?=Yii::t('app', "REPORT")?></a>
                            </div>
                            <?php } ?>
                            <h6><span class="red"><?=empty($proposal) ? 0 : count($proposal)?></span> <?=Yii::t('app','Replies')?></h6>

                            <div class="reviews-holder">
                                <?php if($model->canAcceptOffer()): ?>
                                    <?= $this->render('popup/_offer-price', ['model' => $model, 'nextStage' => \common\models\Offer::STAGE_COUNTEROFFER]) ?>
                                <?php endif; ?>

                                <?php if(!empty($proposal)): ?>
                                        <?php foreach($proposal as $propose): ?>
                                                 <?= $this->render('_replies-without-price',['model' => $model, 'propose' => $propose]) ?>
                                        <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <a class="btn btn-width"><?=Yii::t('app', "SHOW MORE")?></a>
                            </div>


                        </div>        






                        <div class="clear"></div>
                    </div>
