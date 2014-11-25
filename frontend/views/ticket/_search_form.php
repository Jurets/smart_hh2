<?php
use yii\helpers\Html;
?>
<form class="sort" action="" method="post">
                                <fieldset>
                                    <div class="row">
                                    <div class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                        <p>Sort by Price:</p>
                                        <select>
                                            <option>Ascending</option>
                                            <option>Descending</option>
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
                        </form>
