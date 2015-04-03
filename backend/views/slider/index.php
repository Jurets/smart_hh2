<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sliders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Index management'), 'url' => ['/footer-content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Slider',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'picture',
            [
                'attribute' => 'display',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    return Html::img($model->returnUrl(), ['width' => '150']);
                },
            ],
            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete} {update}',
            ],
        ],
    ]); ?>

</div>
