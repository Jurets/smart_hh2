<script src="https://maps.googleapis.com/maps/api/js?key=<?=Yii::$app->params['GoogleAPI']?>&sensor=SET_TO_TRUE_OR_FALSE"
  type="text/javascript"></script>
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Ticket;
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
?>

                    <div class="job-creator row">                    
                        <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
                            <h1><?=$model->title?></h1>


                            <span class="date-time">
                                Created <?=$model->created?>
                            </span>
                            <span class="deadline">
                                Deadline: <span class="red"><!--Tomorrow--></span>
                            </span>  

                            <div class="job-info-holder row">
                                <div class="job-info col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="job-price left">
                                        <p class="price">$<?= is_null($model->price) ? 0 : $model->price?></p>
                                        <p class="measurement">week</p>
                                    </div>
                                    <div class="auction">
                                        Ready to raise on:<br/><span class="red">&dollar;1</span>
                                    </div>
                                </div>
                                <div class="action col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <!--<a href="<?php //echo Url::to(['ticket/delete', 'id'=>$model->id])?>" class="btn btn-delete btn-average">DELETE</a>-->
                                    <?php
                                       echo Html::beginForm(Url::to(['ticket/delete']),'post', ['class'=>'left', 'style'=>'margin-right:20px;']);
                                       echo Html::submitButton(Yii::t('app', 'DELETE'), ['class'=>"btn btn-delete btn-average"]);
                                       echo Html::hiddenInput('id', $model->id);
                                       echo Html::endForm();
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
                                <p class="title">Description:</p>
                                <?= nl2br(\yii\helpers\HtmlPurifier::process($model->description)) ?>
                                <a href="#" class="more">Read full description</a>                                 
                            </div>
                            <div class="location">
                                <?php if($model->job_location !== null): ?>
                                <p class="title">Job Location: <?= Html::encode($model->job_location) ?></p>
                                <?php endif; ?>
                                
                                <?php if( !is_null($model->lat) && !is_null($model->lon) ) { ?>
                                <div id="GoogleLat" style="display:none;"><?=$model->lat?> </div>
                                <div id="GoogleLng"style="display:none;"><?=$model->lon?> </div>
                                <div class="map ">
                                    <div id="map_canvas" style="width:581px;height:352px;"></div>
                                </div>
                                <?php } else { ?>
                                <div class="map">no map</div>
                                <?php } ?>
                            </div>
                            <?= $this->render('view/_comments', ['model' => $model]) ?>
                        </div>
                        <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
                            <?php if($model->status === Ticket::STATUS_PROCESSING){ ?>
                            <div class="action-reply">
                                <a href="#" class="btn btn-average">SET AS DONE</a>
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
                                
                                <a class="btn btn-width">SHOW MORE</a>
                            </div>


                        </div>        






                        <div class="clear"></div>
                    </div>