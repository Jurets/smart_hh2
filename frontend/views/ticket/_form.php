<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Alert;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
?>
<!--<div class="content">-->
              
<div class="job-creator row">  
                <div class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    <?php $action = ($model->isNewRecord) ? Url::to(['ticket/create'], TRUE) : Url::to(['ticket/update', 'id'=>$model->id])?>
                    <?php echo Html::beginForm($action, 'post', ['enctype'=>'multipart/form-data','class'=>'create-job with-background'])?>
                        <fieldset>
                            <?php  echo Alert::widget([
                                        'alertTypes' => ['error' => 'alert-danger'],
                                    ]);
                            ?>
                            <?php echo Html::label(Yii::t('app', 'Title'), 'title')?>
                            <?php echo Html::textInput('title', $model->title)?>
                            <?php echo Html::label(Yii::t('app', 'Choose Date and Time').':', 'finish_day')?>
                            <?php //echo Html::textInput('finish_day', $model->finish_day)?>
                            <?php echo DateTimePicker::widget([
                                'type' => DateTimePicker::TYPE_INPUT,
                                'name' => 'finish_day',
                                'value' => $model->finish_day,
                                'options' => ['format' =>'dd-M-yyyy hh:ii',
                                              'style' => 'display:inline',
                                             ],
                                'pluginOptions' => [
                                              'autoclose' => true
                                             ],
                            ])?>
                            <?php echo Html::label(Yii::t('app', 'Enter location').':', 'location') ?>
                            <?php echo Html::textInput('location', $model->location)?>
                            <div class="description">    
                                <?php echo Html::label(Yii::t('app', 'Description'.':'), 'description')?>
                                <?php echo Html::textarea('description', $model->description)?>
                                <a href="#" class="additional"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Make this information Private</a>
                            </div>
                            <label>Auto-translate to:</label>
                            <select id="translate">
                                <option>Russian</option>
                                <option>Russian</option>
                            </select>
                            <a href="#" class="btn btn-form">MAKE EDITABLE</a>
                            <textarea class="translation" disabled="disabled"></textarea> 
                            <div>
<!--                                <a href="#" class="btn btn-form left">ATTACH A PHOTO</a>-->
                                <?php
                                echo FileInput::widget([
                                    'name' => 'photo',
                                    'options' => [
                                        'multiple'=>false,
                                        ],
                                    'pluginOptions' => [
                                        'showPreview' => true,
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false
                                    ],
                                ]);
                                ?>
                                <p class="attach-photo">Attach a photo to your description. Max file size: 5 Mb, Allowed extensions: JPG/PNG/GIF</p>                            
                                <div class="clearfix"></div>
                            </div>
                            <?php echo Html::label(Yii::t('app','Your price for this job').':', 'price')?>
                            <?php echo Html::textInput('price',$model->price, ['class'=>'yourprice']) ?>
                            <select name="currency" class="currency">
                                <option>USD</option>
                                <option>USD</option>
                            </select>
                            <a href="#" class="currency-price">See current prices for this of job</a>
                            <?php echo Html::submitButton(Yii::t('app','PUBLISH'), ['class'=>'btn btn-width'])?>
                        </fieldset>
                    <div id="addon1"></div>
                    <div id="addon2"></div>
                    <div id="addon3"></div>
                    <div id="addon4"></div>
                    <?php echo Html::endForm();?>

                                        
                </div>
                <?php echo $this->render('_subcategories_panel')?>
</div>                                       
                   
                      
                   
  <!--</div>-->
  <div style="display:none;">
      <div id="slotsquantity"><?php echo Yii::$app->params['slots.quantity']?></div>
  <?php if(isset($categories)) { ?>
  <?php 
  $Items = NULL;
  foreach($categories as $cat_id => $category) { 
      $Items .=  '<div class="lvl1" style="display:block;font-weight:bold;" id='.$cat_id.'>'.$category['cat_name'];
      if(count($category) > 1){
          foreach($category as $i => $subcategory){
              if(is_string($i)) continue;
              $Items .= PHP_EOL.'<div class="lvl2" style="font-weight:normal;" id='.$subcategory['subcat_id'].'>'.$subcategory['subcat_name'].'</div>'.PHP_EOL;
          }
      }
      $Items .= '</div>'.PHP_EOL;
  } 
  ?>
  <?php echo $Items; ?>
  <?php } ?>
  </div>
<style>
    .lvl1{color:red;}
    .lvl2{color:navy;}
    </style>
    