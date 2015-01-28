<?php

use kartik\widgets\StarRating;
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->params['GoogleAPI'] ?>&sensor=SET_TO_TRUE_OR_FALSE"
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
    <!-- the pop-up --> 
    <div id="complain-form" class="pop-up pop-up-edit popup-align-center">
        <a class="close" href="#">×</a>
        <p class="title"><?php echo Yii::t('app', 'Send Complain')?></p>
        <?php echo $this->render('_complain_form', ['model'=>$model,'complain'=>$complain])?>
    </div>
        <!-- additional popup may put here  --!>
    <!-- -->
    <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
        <h1><?= $model->title ?></h1>  


        <span class="date-time">
            Created <?= $model->created ?>
        </span>
        <span class="deadline">
            Deadline: <span class="red">Tomorrow</span>
        </span>   
        <div class="job-info-holder row">
            <div class="job-info col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="job-price left">
                    <p class="price"><?= $model->price ?></p>
                    <p class="measurement">week</p>
                </div>
                <div class="auction">
                    Ready to raise on:<br/><span class="red">&dollar;1</span>
                </div>
            </div>
            <div class="action col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <a href="#" class="btn btn-average">APPLY</a>
                <a href="#" class="btn btn-average">OFFER PRICE</a>
            </div>

        </div>
        <div class="description">
            <p class="title">Description:</p> <a href="#" class="translate right">Перевести на руссский</a>
<?= $model->description ?>
            <a href="#" class="more">Read full description</a>                                 
        </div>
        <div class="location">
            <p class="title">Job Location: 10 Gagarin St, 50/5</p>

<?php if (!is_null($model->lat) && !is_null($model->lon)) { ?>
                <div id="GoogleLat" style="display:none;"><?= $model->lat ?> </div>
                <div id="GoogleLng"style="display:none;"><?= $model->lon ?> </div>
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
            <a href="#" id="complain-report" class="btn btn-average btn-report">REPORT</a>
        </div>        
        <p class="title">Job creator:</p>
        <div class="widget creator">
            <a href="#"><img class="avatar left" alt="avatar" src="<?= Yii::$app->params['upload.url'] . '/' . $user->profile->files->code ?>" /></a>
            <a href="#" class="name-creator">
                <?php
                if (is_null($user->profile->first_name) || is_null($user->profile->last_name)) {
                    echo $user->profile->full_name;
                } else {
                    echo $user->profile->first_name . ' ' . $user->profile->last_name;
                }
                ?>
            </a>
            <p class="active-jobs">Active <a href="#" class="number-jobs">35 jobs</a></p>
        </div>
        <h6><span class="red">13</span> Opinions</h6>
        <div class="mark-creator">
            <!--<img src="/images/star5.png"><span class="vote">(3.5 based on 40 votes)</span>-->
            <?php
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

        </div>

        <div class="reviews-holder">
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
        </div> 


    </div> 
    <div class="clearfix"></div> 
</div>     

<div class="latest-task">
    <h3>Similar Tasks</h3>
    <div class="tasks-holder row">
        <div class="left-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <div class="task-item active">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">                            
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>

            </div>

        </div>
        <div class="right-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <div class="task-item">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">                            
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="task-item">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                    <a href="#" class="btn btn-small">APPLY</a>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Need a nanny for a week</a>
                    <p class="date-time">15:15 JAN 01, 2015</p>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
                </div>
                <div class="clear"></div>
            </div> 

        </div>
        <div class="clear"></div>

    </div>
    <div class="text-center row">
        <a href="#" class="btn">SHOW MORE</a>
    </div>
</div>                       