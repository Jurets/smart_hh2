<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
    $get = Yii::$app->request->get();
?>
<form class="sort" action="<?=Url::to(['/user/index'], true)?>" method="get">
    <?php
    if (Yii::$app->urlManager->enablePrettyUrl != TRUE) {
       echo '<input type="hidden" name="r" value="user/index">';
    }
    ?>
    <?php
    if(isset($get['cid'])){
        echo '<input type="hidden" name="cid" value="'.((int)$get['cid']).'">';
    }
    ?>
                                    <fieldset>
                                        <div class="group">
                                        <?php echo Html::label(Yii::t('app', 'Sort by Price per hour').':')?>
                                        <?php echo Html::dropDownList('sort', 
                                                isset($get['sort']) ? (int)$get['sort'] : NULL,
                                                [
                                                    0=>Yii::t('app','Ascending'),
                                                    1=>Yii::t('app', 'Desceding'),
                                                ]);
                                        ?>
                                        </div>
                                        <?php echo Yii::t('app','and max') // русский язык не влазит ввиду макета - пока без перевода оставлено ?>
                                        <?php echo Html::textInput('max_amount',
                                                isset($get['max_amount']) ? (float)$get['max_amount'] : NULL,
                                                ['class'=>'small']) ?>
                                        <?php echo Html::dropDownList('currency',
                                                isset($get['currency']) ? (int)$get['currency'] : NULL,
                                                [
                                                    0=>Yii::t('app','USD'),
                                                    // add new currency here
                                                ],
                                                ['class'=>'small']
                                                )
                                        ?>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app','Location').':');
                                            echo Html::textInput('location', NULL);
                                        ?>
                                        </div>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app','Jobs Within').':');
                                            echo Html::dropDownList('within',
                                                    isset($get['within']) ? $get['within'] : NULL, 
                                                    [
                                                        1 => 1,
                                                        2 => 2,
                                                        3 => 3,
                                                        100 => 100,
                                                        200 => 200,
                                                    ]);
                                         ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app', 'Rating').':');
                                            echo Html::dropDownList('rating',
                                                    isset($get['rating']) ? $get['rating'] : NULL,
                                                    [
                                                        100 => 100,
                                                        200 => 200,
                                                    ]
                                                    );
                                         ?>
                                        </div>
                                        <div class="group ">
                                        <?php
                                            echo Html::label(Yii::t('app', 'Done Tasks').':');
                                            echo Html::dropDownList('done_tasks',
                                                    isset($get['done_tasks']) ? $get['done_tasks'] : NULL,
                                                    [
                                                        100 => 100,
                                                        200 => 200,
                                                    ]
                                                    );
                                        ?>
                                        </div>
                                        <div class="group">
                                        <?php
                                            echo Html::label(Yii::t('app', 'Created Tasks').':');
                                            echo Html::dropDownList('created_tasks',
                                                    isset($get['created_tasks']) ? $get['created_tasks'] : NULL,
                                                    [
                                                        100 => 100,
                                                        200 => 200,
                                                    ]
                                                    );
                                        ?>
                                        </div>


                                        <div class="clear"></div>
                                        <!--<p class="show">Showing 1 - 10 of 309 results</p>-->
                                        <div class="clear"></div>
                                    </fieldset>
                                        <?php echo Html::submitButton(Yii::t('app', 'SEARCH'), ['class'=>'btn btn-form', 'style'=>'color:white;font-size:20px;']) ?>
                                </form>
