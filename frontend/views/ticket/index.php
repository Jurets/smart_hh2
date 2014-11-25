<?php
    use frontend\assets\PatchAsset;
    PatchAsset::register($this);
    
    use yii\helpers\Html;
    use yii\widgets\ListView;
    use yii\widgets\Breadcrumbs;
    
?>
<?php
     $this->title = Yii::t('app', 'All Task');
     $this->params['breadcrumbs'][] = $this->title;
?>
                <div class="row">
                    
<div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="sidebar">
        <?=$this->render('/layouts/parts/sidebar', ['categories'=>$categories])?>
        <a href="#" class="btn btn-big btn-width">WANNA BE A HELPER?</a>
        <a href="#" class="btn btn-big btn-width btn-red">CREATE A TASK</a>
    </div>
</div>  
                    
                    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="all-task">
                            <h1>ALL Task</h1>
                            <?php echo $this->render('_search_form', [
                                'subcategories'=> !empty($categories['subcategories']) ? $categories['subcategories'] : NULL,
                                ]) ?>
                        <div class="tasks-holder all-tasks">

                                <div class="task-item info-border">
                                    <div class="task-info-price">
                                        <p class="price">&dollar;500</p>
                                        <p class="measurement">week</p>
                                        <a href="#" class="btn-small">APPLY</a>
                                    </div>
                                    <div class="task-info-meta">
                                        <a  href="#" class="title">Web site development for a law company in Moscow</a>
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="autor left">
                                        <img class="left" src="images/avatar-1.jpg" alt="avatar"/>
                                        <p>Alex B.<img src="images/star5.png"/><span  class="vote">(3.5 based on 40 votes)</span></p>
                                        <p>Active 35 jobs</p>
                                    </div>
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
                                        <a href="#" class="btn-small">APPLY</a>
                                    </div>
                                    <div class="task-info-meta">
                                        <a  href="#" class="title">Web site development for a law company in Moscow</a>
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="autor left">
                                        <img class="left" src="images/avatar-1.jpg" alt="avatar"/>
                                        <p>Alex B.<img src="images/star5.png"/><span  class="vote">(3.5 based on 40 votes)</span></p>
                                        <p>Active 35 jobs</p>
                                    </div>
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
                                        <a href="#" class="btn-small">APPLY</a>
                                    </div>
                                    <div class="task-info-meta">
                                        <a  href="#" class="title">Web site development for a law company in Moscow</a>
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="autor left">
                                        <img class="left" src="images/avatar-1.jpg" alt="avatar"/>
                                        <p>Alex B.<img src="images/star5.png"/><span class="vote">(3.5 based on 40 votes)</span></p>
                                        <p>Active 35 jobs</p>
                                    </div>
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
                                        <a href="#" class="btn-small">APPLY</a>
                                    </div>
                                    <div class="task-info-meta">
                                        <a  href="#" class="title">Web site development for a law company in Moscow</a>
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="autor left">
                                        <img class="left" src="images/avatar-1.jpg" alt="avatar"/>
                                        <p>Alex B.<img src="images/star5.png"/><span class="vote">(3.5 based on 40 votes)</span></p>
                                        <p>Active 35 jobs</p>
                                    </div>
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
                                        <a href="#" class="btn-small">APPLY</a>
                                    </div>
                                    <div class="task-info-meta">
                                        <a  href="#" class="title">Web site development for a law company in Moscow</a>
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="autor left">
                                        <img class="left" src="images/avatar-1.jpg" alt="avatar"/>
                                        <p>Alex B.<img src="images/star5.png"/><span class="vote">(3.5 based on 40 votes)</span></p>
                                        <p>Active 35 jobs</p>
                                    </div>
                                    <div class="date-time right">
                                        5:15 JAN 01, 2015 <br/>      
                                        Moscow, RU
                                    </div>
                                    <div class="clearfix"></div>
                                    </div>
                               
                              
                            <nav>
                                <ul class="pagination">
                                  <li><span>Page:</span></li>
                                  <li><a href="#">1</a></li>
                                  <li><a href="#">2</a></li>
                                  <li><a href="#">3</a></li>
                                  <li><a href="#">4</a></li>
                                </ul>
                            </nav>
                            
                            </div>
                        </div>
                    
                    </div>
                   

                    </div>


                    <div class="clear"></div>	