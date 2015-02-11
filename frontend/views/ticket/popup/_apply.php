<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="popup-apply-form">
<?php echo Html::beginForm(Url::to(['renderapplyform']), 'post', ['id'=>'apply_form']);?>
    <?php
    // Hidden Fields
    echo Html::hiddenInput('performer_id', '');
    echo Html::hiddenInput('ticket_id', '');
    ?>
    <div class="apply-form-input">
        <?php echo Html::input('text', 'price', '');?>
    </div>
    <div class="apply-form-button">
        <?php echo Html::button(yii::t('app', 'Submit'), ['id'=>'ajaxApplySubmit', 'class'=>'btn btn-primary']);?>
    </div>
<?php echo Html::endForm();?>
</div>
