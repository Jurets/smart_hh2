<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TicketArchiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tickets Archive');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'user',
                'value' => 'user.username',
            ],
            'description:ntext',
            'title',
             'price',
             [
                 'attribute' => 'is_turned_on',
                 'value' => function($turnedOnName){return $turnedOnName->getIsTurnedOn();}
             ],
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
        'heading' => Yii::t('app', 'Tickets Archive'),
        'type'=>'success',
        ],
        'toolbar' => [
        '{export}',
        ],
    ]); 
    ?>

</div>