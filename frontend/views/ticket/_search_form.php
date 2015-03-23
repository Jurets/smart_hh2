<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
?>
<form class="sort" action="<?=Url::to(['ticket/index', ],true)?>" method="get">
    <?php
    if (Yii::$app->urlManager->enablePrettyUrl != TRUE) {
       echo '<input type="hidden" name="r" value="ticket">';
    }
    ?>
                                <fieldset>
                                    <div class="row">
                                    <div class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <?php echo (isset($_GET['cid'])) ? Html::hiddenInput('cid', (int)$_GET['cid']) : '' ?>
                                        <p>Sort by Price:</p>
                                        <select name="sort">
                                            <option value="0"><?=Yii::t('app', 'Ascending')?></option>
                                            <option value="1"><?=Yii::t('app', 'Descending')?></option>
                                        </select>
                                        and at least
                                        <input class="small" type="text" name="least">
                                        <select name="currency" class="small">
                                            <option>USD</option>
                                            <option>USD</option>
                                        </select> 
                                        <div class="group">
                                            <label for="">Location:</label>
                                            <input name="location" type="text">
                                        </div>
                                        <div class="group">
                                            <label for="">Jobs Within:</label>
                                            <select name="distance">
                                                <option></option>
                                                <option>0.5</option>
                                                <option>1</option>
                                                <option>100</option>
                                                <option>200</option>
                                            </select>
                                        </div>
                                        <div class="group">
                                            <label for="">Sort by Finish Date:</label>
                                            <!--<input class="calendar" type="text">-->
                                            <?php
                                                echo DateTimePicker::widget([
                                                    'type' => DateTimePicker::TYPE_INPUT,
                                                    'name' => 'finish_day',
                                                    'options' => [
                                                        'format' =>'dd-M-yyyy hh:ii',
                                                        'style' => 'display:inline',
                                                    ],
                                                    'pluginOptions' => [
                                                            'autoclose' => true
                                                     ],
                                                    //'language' => 'en',
                                                ]);
                                            ?>
                                        </div>
                                        <div class="clear"></div>
                                        <p class="sort-comment small-text">Seattle, WA or 98124</p>
                                        <p class="sort-comment">Showing 1 - 10 of 309 results</p>
                                    </div>
                                    <div class="right-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <?php if(!is_null($subcategories)) {?>
                                        <p>Category subcats:</p>
                                        <?php foreach($subcategories as $subcategory) { ?>
                                        <?php echo Html::checkbox('sub['.$subcategory->id.']',
                                                isset($_GET['sub'][$subcategory->id]) ? TRUE : FALSE,
                                                ['id' => 'subcat_id_'.$subcategory->id, 'value'=>'*'])
                                                ?>
                                        <?php echo Html::label($subcategory->name, 'subcat_id_'.$subcategory->id) ?><br>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                        
                                </div>
                            </fieldset>
                        <div><?php echo Html::submitInput(Yii::t('app', 'Search'), ['class'=>'btn btn-form', 'style'=>'color:white;font-size:20px;']);?></div>
                        </form>
