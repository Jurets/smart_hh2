<div class="seo-block-1">
    <?php
        $currentCategory = '';
    ?>
<?php foreach($list as $item) { ?>
    <?php
        if($currentCategory != $item['content_left']){
            $currentCategory = $item['content_left'];
            echo '<br>'.'<br>'.$item['content_left'].' '.Yii::t('app', 'in').' '.'<br><br>';
        }
    ?>
<a href="<?php echo $item['reference']?>">
    <?php //echo $item['content_left'].' '.Yii::t('app', 'in').' '.$item['content_right']?>
    <?php echo $item['content_right'] ?>
</a>
    &nbsp;
<?php } ?>
</div>