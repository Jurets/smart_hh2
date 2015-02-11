<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="popup-apply-form">
    <?=Yii::t('app', 'Apply')?>
<div class="ajax-apply-form-errors"></div>
<div class="apply-return-message"></div>
<?php echo Html::beginForm(Url::to(['renderapplyform']), 'post', ['id'=>'apply_form']);?>
    <?php
    // Hidden Fields
    echo Html::hiddenInput('performer_id', '');
    echo Html::hiddenInput('ticket_id', '');
    ?>
    <div class="apply-form-input">
        <?php echo is_null($price) ? Html::input('text', 'price', $price) : '<span style="font-size:40px;">$'.$price.'</span>';?>
    </div>
    <div class="apply-form-button">
        <?php echo Html::button(yii::t('app', 'Submit'), ['class'=>'btn btn-primary ajaxApplySubmit']);?>
    </div>
<?php echo Html::endForm();?>
<div>&nbsp;</div>

</div>
