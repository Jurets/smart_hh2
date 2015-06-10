<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */

//$this->title = Yii::t('app', 'Update {modelClass}: ', [
//    'modelClass' => 'Ticket',
//]) . ' ' . $model->title;
$this->title = Yii::t('app', "Update").' '.Yii::t('app',"Ticket"). ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ticket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'exists' => $exists,
        'list' => NULL,
    ]) ?>

</div>
