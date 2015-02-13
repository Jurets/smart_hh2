<script src="https://maps.googleapis.com/maps/api/js?key=<?=Yii::$app->params['GoogleAPI']?>&sensor=SET_TO_TRUE_OR_FALSE"
  type="text/javascript"></script>
<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

                    <div class="job-creator row">                    
                        <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
                            <h1><?=$model->title?></h1>


                            <span class="date-time">
                                Created JAN 1, 2015 15:15
                            </span>
                            <span class="deadline">
                                Deadline: <span class="red">Tomorrow</span>
                            </span>  

                            <div class="job-info-holder row">
                                <div class="job-info col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="job-price left">
                                        <p class="price"><?php echo '$'. $model->price?></p>
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
                            <div class="description">
                                <p class="title">Description:</p>
                                <?=$model->description?>
                                <a href="#" class="more">Read full description</a>                                 
                            </div>
                            <div class="location">
                                <p class="title">Job Location: 10 Gagarin St, 50/5</p>
                                
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

                        </div>
                        <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
                            <div class="action-reply">
                                <a href="#" class="btn btn-average">SET AS DONE</a>
                                <a href="#" class="btn btn-average btn-report">REPORT</a>
                            </div>
                            <h6><span class="red"><?=empty($proposal) ? 0 : count($proposal)?></span> <?=Yii::t('app','Replies')?></h6>

                            <div class="reviews-holder">

<?php if(!empty($proposal)) { ?>
        <?php foreach($proposal as $propose) { ?>
             <?php if(is_null($model->price)){ ?>
                 <?php echo $this->render('_replies-without-price',['model'=>$model, 'propose'=>$propose]) ?>
             <?php } else { ?>
                 <?php echo $this->render('_replies-with-price',['model'=>$model, 'propose'=>$propose]) ?>
             <?php } ?>
        <?php } ?>
<?php } ?>
                                
                                <a class="btn btn-width">SHOW MORE</a>
                            </div>


                        </div>        






                        <div class="clear"></div>
                    </div>