<?php 
use yii\helpers\Html;
?>
<div id="complain_message"> </div>
<br>
<?php echo Html::beginForm('complain','post', ['id'=>'complain_sender']) ?>
        <?php echo Html::label(Yii::t('app','Category')) ?>
        <?php echo Html::dropDownList('category','', [
            $complain->complains[0] => Yii::t('app',$complain->complains[0]),
            $complain->complains[1] => Yii::t('app',$complain->complains[1]),
            $complain->complains[2] => Yii::t('app',$complain->complains[2]),
            $complain->complains[3] => Yii::t('app',$complain->complains[3]),
        ],['class'=>'btn btn-default']) ?>
        <hr>
        <?php echo Html::label(Yii::t('app', 'Message'))?>
        <br>
        <?php echo Html::textarea('message', '', ['row'=>5])?>
        <br>
        <?php echo Html::hiddenInput('ticket_id', $model->id)?>
        <?php echo Html::hiddenInput('from_user_id', Yii::$app->user->id)?>
        <?php echo Html::button(Yii::t('app','Send'),['id'=>'complain_send', 'class' => 'btn btn-success']) ?>
        <?php //captcha if needed most implement ?>
        <?php echo Html::endForm() ?>