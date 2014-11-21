<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

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
                <li><img class="img" src="images/picture-index.jpg" title="Funky roots" /></li>
                <li><img class="img" src="images/picture-index-2.jpg" title="The long and winding road" /></li>
                <li><img class="img" src="images/picture-index.jpg" title="Happy trees" /></li>
            </ul>

            <div class="header-index col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <? if (Yii::$app->user->isGuest) {
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
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#latestJobs">View latest jobs</a></li>
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#howItWorks">See how it works</a></li>
                <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">Need help?</a></li>
            </ul>
        </div>
    </div>
    <!-- /header -->

    <?= $this->render('../layouts/parts/category')?>

    <!-- content -->
    <div class="content">
    <a name="latestJobs"></a>
    <div class="latest-task">
        <h3>Latest Task</h3>
        <div class="tasks-holder row">
            <div class="left-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="task-item active">
                    <div class="task-info-price">
                        <p class="price">&dollar;500</p>
                        <p class="measurement">week</p>
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
                        <a href="#" class="btn-small">APPLY</a>
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
            <a href="#" class="btn">MORE JOBS</a>
        </div>
    </div>


    <div class="how-it-works row">
        <a name='howItWorks'></a>
        <h2><span class="red">See</span> how it works</h2>
        <div class="left-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <h4>Looking for a <span class="red">helper</span>?</h4>
            <div class="holder-items">
                <a href="#" class="item">
                    <img src="images/signUp.png" alt="Sign Up" class="left"/>
                    <p class="title">Sign Up</p>
                    <p>Create an account. It's easy.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/createAJob.png" alt="Create A Job" class="left"/>
                    <p class="title">Create A Job</p>
                    <p>Caregivers will contact you within 3 days, guaranteed.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/reviewProfiles.png" alt="Review Profiles" class="left"/>
                    <p class="title">Review Profiles</p>
                    <p>Check out your candidates. Request background checks.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/hireAHelper.png" alt="Hire a Helper" class="left"/>
                    <p class="title">Hire a Helper</p>
                    <p>Interview, check references and hire the one that works for you!</p>
                </a>
                <a href="#" class="item">
                    <img src="images/payForHelp.png" alt="Pay for Help" class="left"/>
                    <p class="title">Pay for Help</p>
                    <p>Make and track payments in our Payments Center.</p>
                </a>
            </div>

            <a href="#" class="btn">SIGN UP NOW</a>

        </div>
        <div class="right-column col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <h4>Looking for a <span class="green">job</span>?</h4>
            <div class="holder-items">
                <a href="#" class="item">
                    <img src="images/signUp.png" alt="Sign Up" class="left"/>
                    <p class="title">Sign Up</p>
                    <p>Create an account. It's easy.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/createAJob.png" alt="Create A Job" class="left"/>
                    <p class="title">Create A Job</p>
                    <p>Caregivers will contact you within 3 days, guaranteed.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/reviewProfiles.png" alt="Review Profiles" class="left"/>
                    <p class="title">Review Profiles</p>
                    <p>Check out your candidates. Request background checks.</p>
                </a>
                <a href="#" class="item">
                    <img src="images/hireAHelper.png" alt="Hire a Helper" class="left"/>
                    <p class="title">Hire a Helper</p>
                    <p>Interview, check references and hire the one that works for you!</p>
                </a>
                <a href="#" class="item">
                    <img src="images/payForHelp.png" alt="Pay for Help" class="left"/>
                    <p class="title">Pay for Help</p>
                    <p>Make and track payments in our Payments Center.</p>
                </a>
            </div>
            <a href="#" class="btn">SIGN UP NOW</a>

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