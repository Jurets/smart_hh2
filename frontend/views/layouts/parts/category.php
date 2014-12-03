<?php
use common\components\CategorySlider;
?>

<div class="category row">
    <h2><span class="red">Choose</span> an area<br/><span class="small">where you need help.</span></h2>

    <?php echo CategorySlider::widget(['multiplicity'=>8]) ?>
</div>