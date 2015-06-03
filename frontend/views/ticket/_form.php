<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Alert;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use common\components\Commonhelper;
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
                            <?php echo Html::textInput('title', $model->title,['placeholder'=>Yii::t('app','e.g., Need a nanny for a weekend')])?>
                            <?php echo Html::label(Yii::t('app', 'Choose Date and Time').':', 'finish_day')?>
                            <?php //echo Html::textInput('finish_day', $model->finish_day)?>
                            <?php 
                                echo DateTimePicker::widget([
                                    'language' => Commonhelper::LanguageNormalize(),
                                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                                    'name' => 'finish_day',
                                    
                                    'value' => (int)$model->finish_day == 0  ? '' : Commonhelper::convertDate($model->finish_day),
                                    
                                    'options' => [//'format' =>'dd-M-yyyy hh:ii',
                                                  'style' => 'display:inline;',
                                                  'readonly' => 'true',
                                                 ],
                                    'pluginOptions' => [
                                                  'autoclose' => true,
                                                  'startDate' => date('Y-m-d', time()+86400),
                                                  'format' => 'yyyy-mm-dd H:ii P',
                                                  'language' => '',
                                                 ],
                                ])
                            ?>
                            <br>
                            <?php echo Html::label(Yii::t('app', 'Enter location').':', 'location') ?>
                            <?php echo Html::textInput('location', $model->job_location, ['placeholder'=>Yii::t('app','e.g., USA Florida Miami')])?>
                            
                            <?php echo Html::label(Yii::t('app', 'Zip code').':')?>
                            <?php echo Html::hiddenInput('zip-city', NULL, ['id'=>'zip_id'])?>
                            <div style="">
                                <?php // делаем как независимый partial с передачей выбранного в текстовое поле ?>
                                <?php echo Html::textInput('zip_tf', $model->assembled_zip, ['style'=>'display:block;  ', 'id'=>'zip_tf_id', 'placeholder'=>Yii::t('app',"e.g., 33122 or Miami")])?>
                                <div id="zip-dropdown" data-zipDropdownURL="<?=Url::to(['ticket/zipdropdown'],true)?>">
                                <?php
                                    echo $this->render('view/_zip_dropdown_partial', ['list'=>$list]);
                                ?>
                                </div>
                            </div>
                            <br>
                            
                            <div class="description">    
                                <?php echo Html::label(Yii::t('app', 'Description').':', 'description')?>
                                <?php echo Html::textarea('description', $model->description)?>
                                <a href="#" class="additional"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span><?=Yii::t('app',"Make this information Private")?></a>
                            </div>
                            <label><?=Yii::t('app',"Auto-translate to")?>:</label>
                            <select id="translate">
                                <option>Russian</option>
                                <option>Russian</option>
                            </select>
                            <a href="#" class="btn btn-form"><?=Yii::t('app',"MAKE EDITABLE")?></a>
                            <textarea class="translation" disabled="disabled"></textarea> 
                            <div>
<!--                                <a href="#" class="btn btn-form left">ATTACH A PHOTO</a>-->
                                <?php
                                $fileInputFeature = [
                                    'language' => Commonhelper::LanguageNormalize(),
                                    'name' => 'photo',
                                    'options' => [
                                        'multiple'=>false,
                                        ],
                                    'pluginOptions' => [
                                        'showPreview' => true,
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                    ],
                                ];
                                if( !empty($model->photo) ){
                                    $fileInputFeature['pluginOptions']['initialPreview'] = [
                                        Html::img( Yii::$app->params['upload.url'].DIRECTORY_SEPARATOR.$model->photo, ['class'=>'file-preview-image'] )
                                    ];
                                }
                                echo FileInput::widget($fileInputFeature);
                                ?>
                                <p class="attach-photo"><?=Yii::t('app',"Attach a photo to your description. Max file size: 5 Mb, Allowed extensions: JPG/PNG/GIF")?></p>                            
                                <div class="clearfix"></div>
                            </div>
                            <?php echo Html::label(Yii::t('app','Your price for this job').':', 'price')?>
                            <?php echo Html::textInput('price',$model->price, ['class'=>'yourprice']) ?>
                            <select name="currency" class="currency">
                                <option>USD</option>
                                <option>USD</option>
                            </select>
                            <a href="#" class="currency-price"><?=Yii::t('app',"See current prices for this of job")?></a>
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
      $Items .=  '<div class="lvl1" style="display:block;font-weight:bold;" id='.$cat_id.'>'.Yii::t('app',$category['cat_name']);
      if(count($category) > 1){
          foreach($category as $i => $subcategory){
              if(is_string($i)) continue;
              $Items .= PHP_EOL.'<div class="lvl2" style="font-weight:normal;" id='.$subcategory['subcat_id'].'>'.Yii::t('app',$subcategory['subcat_name']).'</div>'.PHP_EOL;
          }
      }
      $Items .= '</div>'.PHP_EOL;
  } 
  ?>
  <?php echo $Items; ?>
  <?php } ?>
  <?php if(isset($exists)) { ?>
      <div id="exists"><?php echo $exists?></div>
  <?php } ?>
  </div>
<style>
    .lvl1{color:red;}
    .lvl2{color:navy;}
    #exists{color:green;font-weight:bold;}
    </style>
    