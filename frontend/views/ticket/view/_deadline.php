<?php
use common\components\Commonhelper;
use common\models\Ticket;
?>

<?php
    if($model->is_time_enable === Ticket::STATUS_TIME_ON){
        $left = Commonhelper::checkDeadline($model->finish_day);
?>
        <?php if($left > 1) { ?>
            <span class="deadline"><?=Yii::t('app',"Deadline").' '?>:<span class="red"><?=$left?>&nbsp; <?=Yii::t('app',"days left")?></span></span>
        <?php }else{?>
            <?php if($left ==1) { ?>
            <span class="deadline"><?=Yii::t('app',"Deadline").' '?>:<span class="red"><?=Yii::t('app',"Tomorrow")?></span></span>
            <?php }else{ ?>
            <span class="deadline"><?=Yii::t('app',"Deadline").' '?>:<span class="red"><?=Yii::t('app',"Today")?></span></span>
        <?php }} ?>



    <?php } ?>
