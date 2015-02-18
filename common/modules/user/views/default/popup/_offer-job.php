<?php
use yii\helpers\Html;
?>
<div id="offer-job-popup" class="pop-up pop-up-edit popup-align-center">
    <a class="close" href="#">×</a>
    <?php if(empty($tickets)): ?>
        <p class="title"><?php echo Yii::t('app', 'You have no jobs to offer') ?></p>
    <?php else: ?>
    <p class="title"><?php echo Yii::t('app', 'Select Jobs to Offer:') ?></p>
    <br>
    <?= Html::beginForm(['/user/default/offer-job']) ?>
    <div class="offer-job-list">
        <?php foreach($tickets as $ticket): ?>
            <?= $this->render('_offer-job-item', ['model' => $ticket]); ?>
        <?php endforeach; ?>
    </div>
    <?= Html::hiddenInput('user_id', $userId) ?>
    <?= Html::submitButton(Yii::t('app', 'Offer'), ['class' => 'btn btn-success']) ?>
    <?= Html::endForm() ?>
    <?php endif; ?>
</div>