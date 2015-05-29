<?php
use common\components\CategorySlider;
// Choose an area - in monolite context. In translate process must be devided on two parts: <Choose> <an area>
?>

<div class="category row">
    <h2><span class="red"><?=Yii::t('app', 'Choose')?></span><?=' '.Yii::t('app', 'an area');?><br/><span class="small"><?=Yii::t('app', "where you need help")?>.</span></h2>

    <?php echo CategorySlider::widget(['multiplicity'=>8]) ?>
</div>
