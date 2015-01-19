<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<?php
$ticket_title = Yii::t('app', 'User Cabinet');
$this->title = $ticket_title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="person-profile row">
                        <div class="info-1 col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="user-item">
                                <div class="left user-item-info">
                                    <div class="profile-avatar left">
                                        <img class="avatar" src="images/avatar150x150.png" alt="avatar"/>
                                        <a href="#" class="btn btn-average change-photo">CHANGE PHOTO</a>
                                    </div>
                                    <div><span class="user-name">John Doe </span>                                            
                                        <a href="#" class="user-status"><img src="images/icon-facebook.png" alt=""/><span><img src="images/icon-on.png" alt="on"/></span></a>
                                        <a href="#" class="user-status"><img src="images/icon-in.png" alt=""/><span><img src="images/icon-on.png" alt="on"/></span></a>
                                        <a href="#" class="user-status"><img src="images/icon-tel.png" alt=""/><span><img src="images/icon-on.png" alt="on"/></span></a>
                                        <a href="#" class="user-status"><img src="images/icon-phone.png" alt=""/><span><img src="images/icon-on.png" alt="on"/></span></a>
                                    </div>
                                    <p class="user-mark"><img src="images/star5.png" alt=""/><span class="vote">(3.5 based on 40 votes)</span></p>
                                    <img src="images/language-icon.png" alt=""/><span class="info-position">United States</span><a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a><br/>
                                    <span class="measurement">Hourly Rate:</span>
                                    <span class="price">&dollar;500 and up</span><a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    <!--#include file="pop-up-edit.shtml" -->
                                      
                                </div>
                                <div class="clear"></div>
                            </div>

                        </div>
  
                        <div class="info-2 col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row user-contact ">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <p class="title">Languages:</p>
                                    <p>English<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                    <p>Russian<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                    <p class="title">Verified Contacts:</p>
                                    <p>@ XXX@gmail.com<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                    <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>+1(XXX)XXX-XX-XX<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <p class="title">Mailing Address:</p>
                                    <p>105130, Moscow, Russian Federation 100 Gagarin St, 50<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                    <p class="title">PayPal:</p>
                                    <p>johndoe@gmail.com<a href="#" class="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
                                </div>
                            </div>  
                        </div>   

                    </div>
                    

                        <div class="user-cabinet-content">
                            <div class="widget specialties widget-padding">
                                <h1 class="left">My <span class="red">7</span> Specialties</h1>
                                <a href="#" class="btn btn-average right">ADD A SPECIALTY</a>
                                <div class="clearfix"></div>
                                <div class="specialty-holder text-center">
                                    <div class="category-item">
                                    <a href="#" class="specialty-item">
                                        <div class="icon-items">
                                            <img src="images/categories/moving.png" alt="Moving"/>                                            
                                        </div>
                                        <p>Moving</p>                     
                                    </a>
                                        <a class="delete" href="#"><img src="images/icon-delete.png"/></a>
                                    </div>
                                    <div class="category-item">
                                    <a href="#" class="specialty-item">
                                        <div class="icon-items">
                                            <img src="images/categories/events.png" alt="Events"/>                                            
                                         </div>
                                         <p>Events</p>                    
                                    </a>
                                    <a class="delete" href="#"><img src="images/icon-delete.png"/></a>
                                    </div>
                                    <div class="category-item">
                                    <a href="#" class="specialty-item">
                                        <div class="icon-items">
                                            <img src="images/categories/webDisignInternet.png" alt="Web Disign & Internet"/>                                            
                                         </div>
                                        <p>Web Disign &AMP; Internet</p>                     
                                    </a>
                                    <a class="delete" href="#"><img src="images/icon-delete.png"/></a>
                                    </div>
                                    <div class="category-item">
                                    <a href="#" class="specialty-item">
                                        <div class="icon-items">
                                            <img src="images/categories/cooking.png" alt="Cooking"/>                                            
                                         </div>
                                        <p>Cooking</p>                     
                                    </a>
                                    <a class="delete" href="#"><img src="images/icon-delete.png"/></a>
                                    </div>  
                                </div>    

                                

                            </div>  
                            <div class="clearfix"></div>    
                            
                        </div>       
                        <section>
                            <h1 class="left">My <span class="red">Diplomas</span></h1>
                            <a href="#" class="btn btn-average right">NEW LICENSE / DIPLOMA</a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a></td>
                                    </tr>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a>    </td>
                                    </tr>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a>    </td>
                                    </tr>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a>    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                        <section>
                            <h1 class="left">My <span class="red">Verification Docs</span></h1>
                            <a href="#" class="btn btn-average right">NEW DOCUMENT</a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">Password</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a>    </td>
                                    </tr>
                                    <tr>
                                        <td class="number-in-order">1.</td>
                                        <td class="title">Driver License</td>
                                        <td class="image">Image</td>
                                        <td class="size">450 Kb</td>
                                        <td class="delete"><a href="#" class="delete"/><img src="images/icon-delete.png" alt="delete"/></a>    </td>
                                    </tr>                                                                       
                                </tbody>
                            </table>
                        </section>
                   


                    <div class="clear"></div>