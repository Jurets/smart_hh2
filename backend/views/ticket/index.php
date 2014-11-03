<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Ticket',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'user_id',
            'id_category',
            'description:ntext',
            'title',
             'price',
            // 'created',
             'is_turned_on',
            // 'system_key',
             'status',
            // 'is_time_enable:datetime',
             'start_day',
             'finish_day',
            // 'performer_id',
            // 'comment:ntext',
            // 'is_positive',
            // 'rate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
