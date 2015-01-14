<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<form class="sort" action="<?=Url::to(['ticket/index'], true)?>" method="get">
                                    <fieldset>
                                        <div class="group">
                                            <?php echo Html::label(Yii::t('app', 'Sort by Price per hour'.':'))?>
                                            <select>
                                                <option>Ascending</option>
                                                <option>Ascending</option>
                                            </select>
                                        </div>
                                        <?php echo 'and max' // русский язык не влазит ввиду макета ?>
                                        <input class="small" type="text">
                                        <select class="small">
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
                                        <div class="clearfix"></div>
                                        <div class="group">
                                            <label for="">Rating:</label>
                                            <select>
                                                <option>100</option>
                                                <option>200</option>
                                            </select>
                                        </div>
                                        <div class="group ">
                                            <label for="">Done Tasks:</label>
                                            <select>
                                                <option>100</option>
                                                <option>200</option>
                                            </select>
                                        </div>
                                        <div class="group">
                                            <label for="">Created Tasks:</label>
                                            <select>
                                                <option>100</option>
                                                <option>200</option>
                                            </select>
                                        </div>


                                        <div class="clear"></div>
                                        <p class="show">Showing 1 - 10 of 309 results</p>

                                        <div class="clear"></div>
                                    </fieldset>
                                </form>