<script src="https://maps.googleapis.com/maps/api/js?key=<?=Yii::$app->params['GoogleAPI']?>&sensor=SET_TO_TRUE_OR_FALSE"
  type="text/javascript"></script>
<?php
use yii\helpers\Url;
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
                                        <p class="price">$500</p>
                                        <p class="measurement">week</p>
                                    </div>
                                    <div class="auction">
                                        Ready to raise on:<br/><span class="red">&dollar;1</span>
                                    </div>
                                </div>
                                <div class="action col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <a href="#" class="btn btn-delete btn-average">DELETE</a>
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
                            <h6><span class="red">13</span> Replies</h6>

                            <div class="reviews-holder">



                                <div class="reviews-item row">
                                    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <img class="avatar left" src="images/avatar-user.png" alt="avatar"/>
                                        <div><span class="user-name">Alex B.</span>                                           
                                            <div class="date-time">
                                                JAN 1, 2015 15:15
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
                                        <p class="user-mark"><span>Rated:</span><img src="images/star5.png" alt=""/></p>
                                        <p>Completed <span class="number-jobs">540 jobs</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <p class="red">Alex offered a higher price: $1000</p>
                                        Hey Bill, check out my position!
                                        <div class="comment-action">
                                            <a href="#" class="btn btn-average">ACCEPT</a>
                                            <a href="#" class="btn btn-average btn-dark">MAKE ANOTHER OFFER</a>
                                        </div>
                                    </div>
                                </div> 


                                <div class="reviews-item row">
                                    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <img class="avatar left" src="images/avatar-user.png" alt="avatar"/>
                                        <div><span class="user-name">Alex B.</span>                                           
                                            <div class="date-time">
                                                JAN 1, 2015 15:15
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
                                        <p class="user-mark"><span>Rated:</span><img src="images/star5.png" alt=""/></p>
                                        <p>Completed <span class="number-jobs">540 jobs</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Hey Bill, check out my position!
                                        <div class="comment-action">
                                            <a href="#" class="btn btn-average">ACCEPT</a>
                                        </div>
                                    </div>
                                </div> 
                                <div class="reviews-item row">
                                    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <img class="avatar left" src="images/avatar-user.png" alt="avatar"/>
                                        <div><span class="user-name">Alex B.</span>                                           
                                            <div class="date-time">
                                                JAN 1, 2015 15:15
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
                                        <p class="user-mark"><span>Rated:</span><img src="images/star5.png" alt=""/></p>
                                        <p>Completed <span class="number-jobs">540 jobs</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Hey Bill, check out my position!
                                        <div class="comment-action">
                                            <a href="#" class="btn btn-average">ACCEPT</a>
                                        </div>
                                    </div>
                                </div> 
                                <div class="reviews-item row">
                                    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <img class="avatar left" src="images/avatar-user.png" alt="avatar"/>
                                        <div><span class="user-name">Alex B.</span>                                           
                                            <div class="date-time">
                                                JAN 1, 2015 15:15
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
                                        <p class="user-mark"><span>Rated:</span><img src="images/star5.png" alt=""/></p>
                                        <p>Completed <span class="number-jobs">540 jobs</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Hey Bill, check out my position!
                                        <div class="comment-action">
                                            <a href="#" class="btn btn-average">ACCEPT</a>
                                        </div>
                                    </div>
                                </div> 
                                <div class="reviews-item row">
                                    <div class="left col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <img class="avatar left" src="images/avatar-user.png" alt="avatar"/>
                                        <div><span class="user-name">Alex B.</span>                                           
                                            <div class="date-time">
                                                JAN 1, 2015 15:15
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="text-right right col-xs-6 col-sm-6 col-md-6 col-lg-6">                                       
                                        <p class="user-mark"><span>Rated:</span><img src="images/star5.png" alt=""/></p>
                                        <p>Completed <span class="number-jobs">540 jobs</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Hey Bill, check out my position!
                                        <div class="comment-action">
                                            <a href="#" class="btn btn-average">ACCEPT</a>
                                        </div>
                                    </div>
                                </div> 

                                <a class="btn btn-width">SHOW MORE</a>
                            </div>


                        </div>        






                        <div class="clear"></div>
                    </div>