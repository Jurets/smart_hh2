<?php
use yii\helpers\Html;
?>
<div id="offer-job-popup" class="pop-up pop-up-edit popup-align-center">
    <a class="close" href="#">×</a>
    <p class="title"><?php echo Yii::t('app', 'Select Jobs to Offer:') ?></p>
    <br>
    <?= Html::beginForm(['/user/default/offer-job']) ?>
    <div class="offer-job-list">
        <?php for($i=0; $i<10; $i++): ?>
            <?= $this->render('_offer-job-item'); ?>
        <?php endfor; ?>
    </div>
    <?= Html::submitButton(Yii::t('app', 'Offer'), ['class' => 'btn btn-success']) ?>
    <?= Html::endForm() ?>
</div>