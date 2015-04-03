<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php
$this->title = Yii::t('app', 'Category Weight Management');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Index management'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=Html::beginForm(Url::to(['cweight']), 'post')?>
<?=Html::hiddenInput('cat-weight-sign')?>
<table>
<?php 
    foreach($categoryes as $item) {
        echo '<tr>';
        echo '<td style="padding: 10px;">'.$item->name.'</td>';
        echo '<td>'.Html::textInput('cat['.$item->id.']', $item->weight).'</td>';
        echo '</tr>';
    }
 ?>
</table>
<?=Html::submitButton('Save', ['class'=>'btn btn-success'])?>
<?=Html::endForm()?>

