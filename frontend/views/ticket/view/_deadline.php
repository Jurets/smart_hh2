<?php
use common\components\Commonhelper;
use common\models\Ticket;
?>

<?php
    if($model->is_time_enable === Ticket::STATUS_TIME_ON){
        $left = Commonhelper::checkDeadline($model->finish_day);
?>
        <?php if($left > 1) { ?>
            <span class="deadline">Deadline: <span class="red"><?=$left?>&nbsp; days left</span></span>
        <?php }else{?>
            <?php if($left ==1) { ?>
            <span class="deadline">Deadline: <span class="red">Tomorrow</span></span>
            <?php }else{ ?>
            <span class="deadline">Deadline: <span class="red">Today</span></span>
        <?php }} ?>



    <?php } ?>
