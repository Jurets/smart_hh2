<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\grid\GridView as kGridView;

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
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                    'modelClass' => 'Ticket',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?php
    echo kGridView::widget([
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
             [
                 'attribute' => 'is_turned_on',
                 'value' => function($turnedOnName){return $turnedOnName->getIsTurnedOn();}
             ],
            // 'system_key',
             [
                 'attribute' => 'status',
                 'value' => function($statusName){return $statusName->getStatus();}
             ],
             [
                 'attribute' => 'is_time_enable',
                 'value' => function($isTimeEnableName){return $isTimeEnableName->getIsTimeEnable();}
                 ],
             'start_day',
             'finish_day',
            // 'performer_id',
            // 'comment:ntext',
            // 'is_positive',
            // 'rate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {bannmanagement}',
                'buttons' => [
                    'bannmanagement' => function($url, $model){
                     if ($model->isBanned()) {
                        return Html::a('<span class="glyphicon glyphicon-globe"></span>', $url, [
                                    'title' => Yii::t('app', 'Bann'),
                                    'data-confirm' => Yii::t('app', 'Are you sure to unbann this ticket?'),
                                    'data-pjax' => 0,
                        ]);
                    } else {
                        return Html::a('<span class="glyphicon glyphicon-ban-circle"></span>', $url, [
                                    'title' => Yii::t('app', 'Bann'),
                                    'data-confirm' => Yii::t('app', 'Are you sure to bann this ticket?'),
                                    'data-pjax' => 0,
                        ]);
                    }
                }
                ],
            ],
        ],
        'panel' => [
        'bootstrap' => TRUE,
        'heading' => Yii::t('app', 'Tickets'),
        'type'=>'success',
        ],
        'toolbar' => [
        '{export}',
        ],
    ]); 
    ?>

</div>


<?php
//echo kGridView::widget([
//    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
//    'columns' => ['id'],
//    'panel' => [
//        'bootstrap' => TRUE,
//        'heading' => Yii::t('app', 'Additional operations'),
//        'type'=>'success',
//    ],
//    'toolbar' => [
//        '{export}'
//    ],
//]);
?>