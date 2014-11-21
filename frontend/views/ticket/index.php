<?php
    use frontend\assets\PatchAsset;
    PatchAsset::register($this);
?>
<div class="content with-sidebar">
                <div class="breadcrumbs">
                    <a href="#">Breadcrumbs</a> / <span>Tasks</span>
                </div>
                <div class="row">
                    
<div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="sidebar">
        <ul class="sidebar-holder">
            <li><a href="#"><img src="images/icon-allTask.png" alt="icon"/>All Tasks</a></li>
            <li><a href="#"><img src="images/categories/HomeOffice.png" alt="icon"/>Home &amp; Office Repairs</a></li>
            <li><a href="#"><img src="images/categories/CourierServices.png" alt="icon"/>Courier Services</a></li>
            <li><a href="#"><img src="images/categories/Electronic.png" alt="icon"/>Electronic</a></li>
            <li><a href="#"><img src="images/categories/Appliances.png" alt="icon"/>Appliances</a></li>
            <li><a href="#"><img src="images/categories/photo.png" alt="icon"/>Photo &amp; Video</a></li>
            <li><a href="#"><img src="images/categories/Cleaning.png" alt="icon"/>Cleaning</a></li>
            <li><a href="#"><img src="images/categories/VirtualAssistant.png" alt="icon"/>Virtual Assistant</a></li>
            <li><a href="#"><img src="images/categories/healthBeauty.png" alt="icon"/>Health &amp; Beauty</a></li>
            <li><a href="#"><img src="images/categories/moving.png" alt="icon"/>Moving</a></li>
            <li><a href="#"><img src="images/categories/events.png" alt="icon"/>Events</a></li>
            <li><a href="#"><img src="images/categories/webDisignInternet.png" alt="icon"/>Web Design &amp; Internet</a></li>
            <li><a href="#"><img src="images/categories/cooking.png" alt="icon"/>Cooking</a></li>
            <li><a href="#"><img src="images/categories/pet.png" alt="icon"/>Pet</a></li>
            <li><a href="#"><img src="images/categories/Miscellaneous.png" alt="icon"/>Miscellaneous</a></li>
            <li><a href="#"><img src="images/categories/EducationTutoring.png" alt="icon"/>Education &amp; Tutoring</a></li>
        </ul>


        <a href="#" class="btn btn-big btn-width">WANNA BE A HELPER?</a>
        <a href="#" class="btn btn-big btn-width btn-red">CREATE A TASK</a>
    </div>
</div>  
                    
                    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="all-task">
                            <h1>ALL Task</h1>
                            <form class="sort" action="" method="post">
                                <fieldset>
                                    <div class="row">
                                    <div class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                        <p>Sort by Price:</p>
                                        <select>
                                            <option>Ascending</option>
                                            <option>Ascending</option>
                                        </select>
                                        and at least
                                        <input class="small" type="text"/>
                                        <select class="small">
                                            <option>USD</option>
                                            <option>USD</option>
                                        </select> 
                                        <div class="group">
                                            <label for="">Location:</label>
                                            <input type="text"/>
                                        </div>
                                        <div class="group">
                                            <label for="">Jobs Within:</label>
                                            <select>
                                                <option>100</option>
                                                <option>200</option>
                                            </select>
                                        </div>
                                        <div class="group">
                                            <label for="">Sort by Finish Date:</label>
                                            <input class="calendar" type="text"/>
                                        </div>
                                        <div class="clear"></div>
                                        <p class="sort-comment small-text">Seattle, WA or 98124</p>
                                        <p class="sort-comment">Showing 1 - 10 of 309 results</p>
                                    </div>
                                    <div class="right-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <p>Category subcats:</p>
                                        <input type="checkbox"/><label for="">painting</label><br/>
                                        <input type="checkbox"/><label for="">furniture assembly</label><br/>
                                        <input type="checkbox"/><label for="">plumbing</label><br/>
                                        <input type="checkbox"/><label for="">electrical</label><br/>
                                        <input type="checkbox"/><label for="">handyman </label><br/>
                                    </div>

                                </div>
                            </fieldset>
                        </form>


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
                
            </div>		