<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\StarRating;
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
<?php echo is_null($profile->first_name) || is_null($profile->last_name) ? $profile->full_name : $profile->first_name . ' ' . $profile->last_name ?>
                    </span>                                            
                    <?php foreach ($profile->user->getAllSocialNetworks() as $userSocialNetwork): ?>
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
                        'id' => 'the-star-rating',
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
                    <a href="#" class="btn btn-width">OFFER A JOB</a>
                </div>
            </div>
            <div class="user-contact col-xs-6 col-sm-4 col-md-4 col-lg-6">
                <p class="title">Languages:</p>
                <p class="">English, Russian</p>
                <p class="title">Verified Contacts:</p>
                <p class="">@XXXX@gmail.com</p>
                <p class=""><img src="" alt="" />+1 (XXX) XXX-XX-XX</p>
            </div>
        </div>  
    </div>   

</div>
<div class="row">
    <div class="reviews left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
        <h1 class="left">Your Jobs</h1>
        <p class="user-info right">
            <a href="#" class="positive">Created</a>
            <a href="#" class="negative">Applied</a>
        </p>
        <div class="clear"></div>
        <div class="reviews-holder">
            <div class="task-item info-border">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Web site development for a law company in Moscow</a>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                </div>
                <div class="clearfix"></div>
                <div class="date-time right">
                    5:15 JAN 01, 2015 <br/>      
                    Moscow, RU
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="task-item info-border">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Web site development for a law company in Moscow</a>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                </div>
                <div class="clearfix"></div>
                <div class="date-time right">
                    5:15 JAN 01, 2015 <br/>      
                    Moscow, RU
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="task-item info-border">
                <div class="task-info-price">
                    <p class="price">&dollar;500</p>
                    <p class="measurement">week</p>
                </div>
                <div class="task-info-meta">
                    <a  href="#" class="title">Web site development for a law company in Moscow</a>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                </div>
                <div class="clearfix"></div>
                <div class="date-time right">
                    5:15 JAN 01, 2015 <br/>      
                    Moscow, RU
                </div>
                <div class="clearfix"></div>
            </div>            
            <a class="btn btn-width">SHOW MORE</a>       
        </div>    

    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-12 col-lg-5">
        <?=$this->render('_profile_spec',['profile'=>$profile,'userSpecialities'=>$userSpecialities])?>
        <?=$this->render('_profile_diploma',['diplomas' => $diplomas])?>
    </div> 
    <div class="reviews left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
        <h1 class="left"><span class="red">40</span> Reviews</h1>
        <p class="user-info right"> Show:
            <a href="#" class="positive"><img src="/images/icon-positive.png" alt=""/>Positive</a>
            <a href="#" class="negative"><img src="/images/icon-negative.png" alt=""/>Negative</a>
        </p>
        <div class="clear"></div>
        <div class="reviews-holder">
            <div class="reviews-item row">
                <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="#">
                        <img class="avatar left" src="/images/avatar-user.png" alt="avatar"/>
                    </a>
                    <a href="#" class="user-name">Alex B.</p></a>                                           
                    <div class="date-time">
                        JAN 1, 2015 15:15
                    </div>

                </div>
                <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                </div>
            </div>  
            <div class="reviews-item row">
                <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="#">
                        <img class="avatar left" src="/images/avatar-user.png" alt="avatar"/>
                    </a>
                    <a href="#" class="user-name">Alex B.</p></a>                                           
                    <div class="date-time">
                        JAN 1, 2015 15:15
                    </div>

                </div>
                <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                </div>
            </div>  
            <div class="reviews-item row">
                <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="#">
                        <img class="avatar left" src="/images/avatar-user.png" alt="avatar"/>
                    </a>
                    <a href="#" class="user-name">Alex B.</p></a>                                           
                    <div class="date-time">
                        JAN 1, 2015 15:15
                    </div>

                </div>
                <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                </div>
            </div>  
            <div class="reviews-item row">
                <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="#">
                        <img class="avatar left" src="/images/avatar-user.png" alt="avatar"/>
                    </a>
                    <a href="#" class="user-name">Alex B.</p></a>                                           
                    <div class="date-time">
                        JAN 1, 2015 15:15
                    </div>

                </div>
                <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                </div>
            </div>  
            <div class="reviews-item row">
                <div class="left col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="#">
                        <img class="avatar left" src="/images/avatar-user.png" alt="avatar"/>
                    </a>
                    <a href="#" class="user-name">Alex B.</p></a>                                           
                    <div class="date-time">
                        JAN 1, 2015 15:15
                    </div>

                </div>
                <div class="text-right right col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    <p class="task-title"><img src="/images/icon-task.png" alt=""/>To "<a href="#" class="red">Need a nanny for a weekend</a>" task</p>
                    <p class="user-mark"><span>Rated:</span><img src="/images/star5.png" alt=""/></p>

                </div>
                <div class="clearfix"></div>
                <div class="comment col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    John is a brilliant helper, with great skills almost in all areas. 
                    He was my daughter&rsquo;s nanny for a weekend, he cleaned my whole house, 
                    he upgraded my PC software and he even made an outstanding design for my new website!                                    
                    Such people should live forever, thanks man.
                </div>
            </div>  
            <a class="btn btn-width">SHOW MORE</a>       
        </div>    

    </div>    
</div>       





<div class="clear"></div>
