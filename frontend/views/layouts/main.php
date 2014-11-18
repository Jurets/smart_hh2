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

                            <!--#include file="header.shtml" -->

                            <div class="header row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <a href="#" class="logo"><img src="images/logo.png" alt="HelpingHut"/></a>
                                </div>
                                <div class=" col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="top-nav">
                                        <!--
                                        <form id="search" action="" method="post">
                                            <fieldset>
                                                <input type="text" placeholder="Search for jobs or helpers you need"/>
                                                <input type="submit" value=""/>
                                            </fieldset>
                                        </form>
                                        -->
                                        <a href="#" class="logIn">Log In</a>
                                        <a href="#" class="joinNow">Join Now</a>


                                        <select id="language">
                                            <option value="0" data-imagesrc="images/language-icon.png">English</option>
                                            <option value="1" data-imagesrc="images/language-icon.png">English</option>
                                        </select>


                                    </div> 
                                </div>
                            </div>
                        </div>                       



                    </div>
                </div>
                <!--#include file="findHelp.shtml" --> 
                <div class="find-help row">

                    <div class="find-help-content col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2>Find <span class="red">Help</span><br/><span class="small"> save some time</span></h2>
                        <a href="#" class="btn btn-help">Create a Task</a>
                        <p>Request people to do what you need.</p>
                        <a href="#" class="btn btn-help">Find a Helper</a>
                        <p>Find someone special for you task</p>
                    </div>

                </div>

                <div class="row">
                    <div class="main-nav col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul>
                            <li class="active col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">Helping Hut</a></li>
                            <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">View latest jobs</a></li>
                            <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">See how it works</a></li>
                            <li class="col-xs-12 col-sm-12 col-md-6 col-lg-3"><a href="#">Need help?</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /header -->


                <div class="category row">
                    <h2><span class="red">Choose</span> an area<br/><span class="small">where you need help.</span></h2>


                    <ul class="bxslider">
                        <li class="">
                            <div class="category-holder">
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/HomeOffice.png" alt="Home & Office"/>
                                    </div>    
                                    <p>Home &AMP; Office Repairs</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/CourierServices.png" alt="Courier Services"/>
                                    </div>    
                                    <p>Courier Services</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/Electronic.png" alt="Electronic"/>
                                    </div>    
                                    <p>Electronic</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/Appliances.png" alt="Appliances"/>
                                    </div>    
                                    <p>Appliances</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/photo.png" alt="Photo"/>
                                    </div>    
                                    <p>Photo &AMP; Video</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/Cleaning.png" alt="Cleaning"/>
                                    </div>    
                                    <p>Cleaning"</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/VirtualAssistant.png" alt="Virtual Assistant"/>
                                    </div>    
                                    <p>Virtual Assistant</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/healthBeauty.png" alt="Health Beauty.png"/>
                                    </div>    
                                    <p>Health &AMP; Beauty</p>
                                </a>

                                <div class="clear"></div>
                            </div>
                        </li>
                        <li>
                            <div class="category-holder">
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/moving.png" alt="Moving"/>
                                    </div>    
                                    <p>Moving</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/events.png" alt="Events"/>
                                    </div>    
                                    <p>Events</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/webDisignInternet.png" alt="Web Disign & Internet"/>
                                    </div>    
                                    <p>Web Disign &AMP; Internet</p>
                                </a>                         
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/cooking.png" alt="Cooking"/>
                                    </div>    
                                    <p>Cooking</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/pet.png" alt="Pet"/>
                                    </div>    
                                    <p>Pet</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/Miscellaneous.png" alt="Miscellaneous"/>
                                    </div>    
                                    <p>Miscellaneous</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/RunErrands.png" alt="Run Errands"/>
                                    </div>    
                                    <p>Run Errands</p>
                                </a>
                                <a href="#" class="icon-items">
                                    <div>
                                        <img src="images/EducationTutoring.png" alt="Education Tutoring"/>
                                    </div>    
                                    <p>Education Tutoring</p>
                                </a>                        
                                <div class="clear"></div>
                            </div>
                        </li>
                    </ul>
                </div> 
                <!-- content -->
                <div class="content">
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

                <!--#include file="footer.shtml" -->	
                <div class="clearfooter">

                </div>


                <!-- footer -->
                <div class="footer">
                    <div class="row footer-top">
                        <div class="column column-logo col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <a href="#" class="footer-logo"><img src="images/logo-footer.png" alt="HelpingHut"/></a>
                            <div class="copyright">&COPY; 2014</div>
                        </div>
                        <div class="column column-help col-xs-6 col-sm-6 col-md-6 col-lg-4">
                            <a href="#">Instant help in a click.</a>
                        </div>
                        <div class="column column-social-link col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <p>Join Us on</p>
                            <ul class="sicial-link">
                                <li><a href="#"><img src="images/facebook.png" alt="Facebook" /></a></li>
                                <li><a href="#"><img src="images/twitter.png" alt="Twitter" /></a></li>
                                <li><a href="#"><img src="images/google.png" alt="Googlle+" /></a></li>
                                <li><a href="#"><img src="images/youtube.png" alt="You Tube" /></a></li>                
                            </ul>
                            <div class="clear"></div>
                        </div>

                        <div class="column column-nav col-xs-6 col-sm-6 col-md-6 col-lg-2">
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Terms & Agreement</a></li>
                                <li><a href="#">Contact US</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>

                    </div>
                    <div class="footer-nav row">

                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>PC Help</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Appliances</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Courier Services</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Photo & Video</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>PC Help</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Appliances</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>        
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Courier Services</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
                            <h6>Photo & Video</h6>
                            <ul>
                                <li><a href="#">Data restore</a></li>
                                <li><a href="#">Virus removal</a></li>
                                <li><a href="#">PC repair</a></li>
                                <li><a href="#">Upgrade</a></li>
                                <li><a href="#">OS install</a></li>
                                <li><a href="#">Software install</a></li>
                                <li><a href="#">Drivers install</a></li>
                                <li><a href="#">PC Configuration</a></li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <!-- /footer -->
        </div>
        <!-- /main -->



    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>