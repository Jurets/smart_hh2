<!--<div class="footer-nav row">

        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>PC Help</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Appliances</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Courier Services</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Photo & Video</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>PC Help</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Appliances</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Courier Services</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6>Photo & Video</h6>
            <ul>
                <li><a href="#">Data restore</a></li>
                <li><a href="#">Virus removal</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Upgrade</a></li>
                <li><a href="#">OS install</a></li>
                <li><a href="#">Software install</a></li>
                <li><a href="#">Drivers install</a></li>
                <li><a href="#">PC Configuration</a></li>
                <li><a href="#">More</a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>-->


<?php

use yii\helpers\Url;
?>
<div class="footer-nav row">
    <?php $outsideIterator = 1 ?>
    <?php foreach ($categoryList as $category) { ?>
    <?php $insideIterator = 1 ?>
        <div class="column col-xs-6 col-sm-6 col-md-6 col-lg-3">
            <h6><?= Yii::t('app', $category['title'])?></h6>
            <ul>
                <?php foreach ($category['subcat'] as $subcategory) { ?>
                    <?php
                    if (str_word_count($subcategory['title']) > 3) {
                        $buff_arr = explode(' ', $subcategory['title'], 3);
                        unset($buff_arr[2]);
                        $buff = implode(' ', $buff_arr);
                    } else {
                        $buff = $subcategory['title'];
                    }
                    ?>
                    <li><a href="<?= Url::to(['ticket/', 'cid' => $subcategory['cid']], true) ?>"><?= Yii::t('app',$buff)?></a></li>
                    <?php
                    /* comment this if need show all exists subcategories */
                    if ($insideIterator == 8) {
                        break;
                    }
                    $insideIterator ++;
                    ?>
        <?php } ?>
            </ul>
        </div>
        <?php
        /* comment this if need show all exists categories */
        if ($outsideIterator == 8) {
            break;
        }
        $outsideIterator ++;
        ?>
<?php } ?>

    <div class="clear"></div>

</div>