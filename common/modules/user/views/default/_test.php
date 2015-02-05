<?php
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php 
var_dump($users);
echo Html::beginForm(Url::to(['test']), 'post');
echo Html::label('From User').'&nbsp;';
echo Html::dropDownList('from_user',NULL, $users).'<br><br>';
echo Html::label('From User').'&nbsp;';
echo Html::dropDownList('to_user',NULL, $users).'<br><br>';
echo Html::textarea('message', NULL, ['rows'=>10, 'cols'=>100]).'<br><br>';
echo Html::submitButton();
echo Html::endForm();
?>