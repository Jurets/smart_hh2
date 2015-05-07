<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title); ?></title>
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody(); ?>

    <div class="basis">

    <!-- main -->
    <div class="main container">
    <div class="row">
        <div class="header-slider col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <ul class="imgslider">
                <?php if(empty($sliders)) { ?>
                <li><img class="img" src="images/picture-index.jpg" title="Funky roots" /></li>
                <li><img class="img" src="images/picture-index-2.jpg" title="The long and winding road" /></li>
                <li><img class="img" src="images/picture-index.jpg" title="Happy trees" /></li>
                <?php } ?>
                <?php foreach($sliders as $slider) { ?>
                <img src="<?=Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $slider->picture?>" title="<?=$slider->title?>">
                <?php } ?>
            </ul>

            <div id="header_refresh" class="header-index col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php if (Yii::$app->user->isGuest) {
                    echo $this->render('/../views/layouts/parts/header');
                }else echo $this->render('/../views/layouts/parts/header_login')?>
            </div>

        </div>
    </div>

    <?= $this->render('../layouts/parts/findHelp')?>

    <div class="row">
        <div class="main-nav col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul>
                <li class="active col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">Helping Hut</a></li>
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#latestJobs" class="scrollto">View latest jobs</a></li>
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a class="scrollto" href="#howItWorks">See how it works</a></li>
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">Need help?</a></li>
            </ul>
        </div>
    </div>
    <!-- /header -->

    <?= $this->render('../layouts/parts/category')?>

    <!-- content -->
    <div class="content">
    <a name="latestJobs"></a>

    <?=
    \frontend\widgets\TwoColumnTasks::widget([
        'caption' => Yii::t('app', 'Latest Tasks'),
        'tasks' => $latestTasks,
    ])
    ?>

    <div class="how-it-works row">
        <a name='howItWorks'></a>
        <h2><span id="howItWorks" class="red">See</span> how it works</h2>
        <div class="left-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <h4>Looking for a <span class="red">helper</span>?</h4>
            <div class="holder-items">
                <a href="#" class="item">
                    <img src="images/signUp.png" alt="Become a Member" class="left"/>
                    <p class="title">Become a <span class="red">Member</span> of Helping Hut</p>
                    <p>It's easy & free!</p>
                </a>
                <a href="#" class="item">
                    <img src="images/createAJob.png" alt="Create a Job" class="left"/>
                    <p class="title">Create a Job Listing</p>
                    <p>Tell us what you need.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/reviewProfiles.png" alt="Search for a Helper" class="left"/>
                    <p class="title">Search for a Helper</p>
                    <p>Find the perfect helper for you.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/hireAHelper.png" alt="Hire a Helper" class="left"/>
                    <p class="title">Hire the Perfect Helper</p>
                    <p>Select someone with your desired skills.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/payForHelp.png" alt="Pay for the Service" class="left"/>
                    <p class="title">Pay for the Service</p>
                    <p>Using our secure online methods.</p>
                </a>
            </div>

            <?php //echo Html::a(Yii::t('app', 'SIGN UP NOW'), Url::to(['registration/customer'],true),['class'=>'btn']) ?>
            <?php echo Html::a(Yii::t('app', 'SIGN UP NOW'), '#',['class'=>'btn','onclick'=>'javascript:REGWIN.signUpNowChoise(1)']) ?>

        </div>
        <div class="right-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <h4>Looking for a <span class="green">job</span>?</h4>
            <div class="holder-items">
                <a href="#" class="item">
                    <img src="images/becomeHelper.png" alt="Become a Helper" class="left"/>
                    <p class="title">Become a <span class="green">Helper</span> on Helping Hut</p>
                    <p>It's easy & free!</p>
                </a>
                <a href="#" class="item">
                    <img src="images/createHelper.png" alt="Create a Helper" class="left"/>
                    <p class="title">Create a Helper Profile</p>
                    <p>Describe your skills and talents.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/reviewPostings.png" alt="Review Postings" class="left"/>
                    <p class="title">Review the Latest Job Postings</p>
                    <p>Search for a job posting that best applies to you.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/getHired.png" alt="Get Hired" class="left"/>
                    <p class="title">Get Hired</p>
                    <p>Apply to jobs that best suits you.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/getPaid.png" alt="Get Paid" class="left"/>
                    <p class="title">Get Paid</p>
                    <p>We have various payment options to choose from.</p>
                </a>
            </div>
            <?php //echo Html::a(Yii::t('app', 'SIGN UP NOW'), Url::to(['registration/performer'],true),['class'=>'btn']) ?>
            <?php echo Html::a(Yii::t('app', 'SIGN UP NOW'), '#',['class'=>'btn','onclick'=>'javascript:REGWIN.signUpNowChoise(2)']) ?>
        </div>
    </div>
    <div class="clear"></div>

    <div class="mention row">
        <h3>As mentioned by</h3>
        <a href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-2"><img src="images/smartMoney.png" alt="Smart Money"/></a>
        <a href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-3"><img src="images/yahoo.png" alt="Yahoo"/></a>
        <a href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-2"><img src="images/theStreet.png" alt="The Street"/></a>
        <a href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-3"><img src="images/morningstar.png" alt="Morningstar"/></a>
        <a href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-2"><img src="images/reuters.png" alt="Reuters"/></a>
        <div class="clear"></div>
    </div>

    </div>

    <!-- /content -->

    <div class="clearfooter">

    </div>

    <?= $this->render('../layouts/parts/footer')?>
    </div>
    </div>
    <!-- /main -->

    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>
