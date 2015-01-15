<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
    $actionUrlPrepare = (Yii::$app->urlManager->enablePrettyUrl === TRUE) ? '/user/index' : '';
    $formPrepare = Yii::$app->request->get();
    var_dump($formPrepare);
?>
<form class="sort" action="<?=Url::to([$actionUrlPrepare], true)?>" method="get">
                                    <fieldset>
                                        <div class="group">
                                        <?php echo Html::label(Yii::t('app', 'Sort by Price per hour'.':'))?>
                                        <?php echo Html::dropDownList('sort', 
                                               isset($formPrepare['sort']) ? (int)$formPrepare['sort'] : NULL,
                                                [
                                                    0=>Yii::t('app','Ascending'),
                                                    1=>Yii::t('app', 'Desceding'),
                                                ]);
                                        ?>
                                        </div>
                                        <?php echo 'and max' // русский язык не влазит ввиду макета - пока без перевода оставлено ?>
                                        <?php echo Html::textInput('max_amount', NULL, ['class'=>'small']) ?>
                                        <?php echo Html::dropDownList('currency',
                                                NULL,
                                                [
                                                    0=>Yii::t('app','USD'),
                                                    // add new currency here
                                                ],
                                                ['class'=>'small']
                                                )
                                        ?>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app','Location'.':'));
                                            echo Html::textInput('location', NULL);
                                        ?>
                                        </div>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app','Jobs Within'.':'));
                                            echo Html::dropDownList('within',
                                                    NULL, 
                                                    [
                                                        0 => 100,
                                                        1 => 200,
                                                    ]);
                                         ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="group">
                                        <?php 
                                            echo Html::label(Yii::t('app', 'Rating'.':'));
                                            echo Html::dropDownList('rating',
                                                    NULL,
                                                    [
                                                        0 => 100,
                                                        1 => 200,
                                                    ]
                                                    );
                                         ?>
                                        </div>
                                        <div class="group ">
                                        <?php
                                            echo Html::label(Yii::t('app', 'Done Tasks'.':'));
                                            echo Html::dropDownList('done_tasks',
                                                    NULL,
                                                    [
                                                        0 => 100,
                                                        1 => 200,
                                                    ]
                                                    );
                                        ?>
                                        </div>
                                        <div class="group">
                                        <?php
                                            echo Html::label(Yii::t('app', 'Created Tasks'.':'));
                                            echo Html::dropDownList('created_tasks',
                                                    NULL,
                                                    [
                                                        0 => 100,
                                                        1 => 200,
                                                    ]
                                                    );
                                        ?>
                                        </div>


                                        <div class="clear"></div>
                                        <p class="show">Showing 1 - 10 of 309 results</p>
                                        <div class="clear"></div>
                                    </fieldset>
                                        <?php echo Html::submitButton('submit') ?>
                                </form>