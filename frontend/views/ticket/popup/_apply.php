<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
    echo Html::beginForm(Url::to(['renderapplyform']), 'post');
    
    echo Html::input('button', Yii::t('app','Submit') ,['id'=>'ajaxApplySubmit']);
    echo Html::endForm();
?>