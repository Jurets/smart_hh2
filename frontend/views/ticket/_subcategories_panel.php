<?php
/*
 * Subcategories panel
 * Use for rendering 2 checkbox panel for subcategories manipulation
 * Remake for 3 subcategories only
 */
?>
<div data-thumb="<?=Yii::t('app',"Select if you need")?>"></div>
<div class="right-column choice-categories col-xs-12 col-sm-12 col-md-12 col-lg-5">
    <p><?=Yii::t('app',"Choose the categories for you job")?>:</p>
    <p class="commentary"><?=Yii::t('app',"You can choose up to 2 categories and 3 subcategories")?></p>
    <ol class="select-categories">
        <li class="number-in-order">
            <select id="slot1"></select>
        </li>
        <li class="number-in-order">
            <select id="slot2"></select>
        </li><!--
        <li class="number-in-order">
            <select id='slot3'></select>
        </li>
        <li class="number-in-order">
            <select id="slot4"></select>
        </li>-->

    </ol>
    <ol class="option-categories">

        <li class="sub-categiries" id="pnl1"></li>
        <li class="sub-categiries" id="pnl2"></li><!--
        <li class="sub-categiries" id="pnl3"></li>
        <li class="sub-categiries" id="pnl4"></li>-->
    </ol>
</div>     