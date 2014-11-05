<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Ticket',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        /*'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
        },*/
        'itemView' => '_view',
        'viewParams' => array(
            'list' => $list,
        ),
        'summary' => '', //summary info (count of items) not show!
    ]) ?>

</div>
