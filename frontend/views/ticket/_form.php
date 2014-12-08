<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!--<div class="content">-->
              
                       <div class="job-creator row">  
                <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    
                    <?php echo Html::beginForm(Url::to(['ticket/create'], TRUE), 'post', ['enctype'=>'multipart/form-data','class'=>'create-job with-background'])?>
                        <fieldset>
                            <?php echo Html::label(Yii::t('app', 'Title'), 'title')?>
                            <?php echo Html::textInput('title')?>
                            <?php echo Html::label(Yii::t('app', 'Choose Date and Time').':', 'finish_day')?>
                            <?php echo Html::textInput('finish_day')?>                           
                            <?php echo Html::label(Yii::t('app', 'Enter location').':', 'location') ?>
                            <?php echo Html::textInput('location')?>
                            <div class="description">    
                                <?php echo Html::label(Yii::t('app', 'Description'.':'), 'description')?>
                                <?php echo Html::textarea('description')?>
                                <a href="#" class="additional"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Make this information Private</a>
                            </div>
                            <label>Auto-translate to:</label>
                            <select id="translate">
                                <option>Russian</option>
                                <option>Russian</option>
                            </select>
                            <a href="#" class="btn btn-form">MAKE EDITABLE</a>
                            <textarea class="translation"></textarea> 
                            <div>
                                <a href="#" class="btn btn-form left">ATTACH A PHOTO</a>
                                <p class="attach-photo">Attach a photo to your description. Max file size: 5 Mb, Allowed extensions: JPG/PNG/GIF</p>                            
                                <div class="clearfix"></div>
                            </div>
                            <?php echo Html::label(Yii::t('app','Your price for this job').':', 'price')?>
                            <?php echo Html::textInput('price', NULL, ['class'=>'yourprice']) ?>
                            <select name="currency" class="currency">
                                <option>USD</option>
                                <option>USD</option>
                            </select>
                            <a href="#" class="currency-price">See current prices for this of job</a>
                            <a href="#" class="btn btn-width">PUBLISH</a>                            
                        </fieldset>
                    <?php echo Html::endForm();?>

                                        
                </div>
                <div class="right-column choice-categories col-xs-12 col-sm-12 col-md-12 col-lg-5">
                    <p>Choose the categories for you job:</p>
                    <p class="commentary">You can choose up to 4 categories and 12 subcategories</p>
                    <ol class="select-categories">
                        <li class="number-in-order">
                        <select>
                            <option>Select if you need</option>
                            <option>Home &amp; Office repairs</option>
                        </select>
                        </li>
                        <li class="number-in-order">
                        <select>
                            <option>Select if you need</option>
                            <option>Home &amp; Office repairs</option>
                        </select>
                        </li><li class="number-in-order">
                        <select>
                            <option>Select if you need</option>
                            <option>Home &amp; Office repairs</option>
                        </select>
                        </li><li class="number-in-order">
                        <select>
                            <option>Select if you need</option>
                            <option>Home &amp; Office repairs</option>
                        </select>
                        </li>
                                                
                    </ol>
                <ol class="option-categories">
                    
                    <li class="sub-categiries">
                        <input type="checkbox"  /><label>1. Home &amp; Office repairs</label>  
                        <ul class="select-sub-categories">
                            <li><input type="checkbox" /><label>painting</label></li>
                            <li><input type="checkbox" /><label>furniture assembly</label></li>
                            <li><input type="checkbox" /><label>plumbing</label></li>
                            <li><input type="checkbox" /><label>electrical</label></li>
                            <li><input type="checkbox" /><label>handyman</label></li>
                        </ul>
                    </li>
                    <li class="sub-categiries">
                        <input type="checkbox" /><label>2. Health &amp; Beauty</label>
                        <ul class="select-sub-categories">
                            <li><input type="checkbox" /><label>painting</label></li>
                            <li><input type="checkbox" /><label>furniture assembly</label></li>
                            <li><input type="checkbox" /><label>plumbing</label></li>
                            <li><input type="checkbox" /><label>electrical</label></li>
                            <li><input type="checkbox" /><label>handyman</label></li>
                        </ul>
                    </li>
                     <li class="sub-categiries">
                        <input type="checkbox" /><label>3. Courier Services</label>
                        <ul class="select-sub-categories">
                            <li><input type="checkbox" /><label>painting</label></li>
                            <li><input type="checkbox" /><label>furniture assembly</label></li>
                            <li><input type="checkbox" /><label>plumbing</label></li>
                            <li><input type="checkbox" /><label>electrical</label></li>
                            <li><input type="checkbox" /><label>handyman</label></li>
                        </ul>
                    </li>
                    <li class="sub-categiries">
                        <input type="checkbox" /><label>4. Health &amp; Beauty</label>
                        <ul class="select-sub-categories">
                            <li><input type="checkbox" /><label>painting</label></li>
                            <li><input type="checkbox" /><label>furniture assembly</label></li>
                            <li><input type="checkbox" /><label>plumbing</label></li>
                            <li><input type="checkbox" /><label>electrical</label></li>
                            <li><input type="checkbox" /><label>handyman</label></li>
                        </ul>
                    </li>
            </ol>
                   
                    
                    
               </div>     
                       </div>                                       
                   
                      
                   
  <!--</div>-->