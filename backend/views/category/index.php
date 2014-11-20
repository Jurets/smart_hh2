<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('app', 'Create {modelClass}', [
//    'modelClass' => 'Category',
//]), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'parent_id',
//            'level',
            [
                'attribute' => '',
                'format' => 'html',
                'value' => function($data) { 
                        if(empty($data->picture)){
                            return Html::img('/images/categories/defaultCategory.png', ['width'=>50]);
                        }
                        return Html::img('/images/categories/'.$data->picture, ['width'=>50]); },
            ],
            'picture',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{subcategory}',
                'buttons' => [
                    'subcategory' => function ($url, $model) {
                            return Html::a('Subcategory', $url, [
                                    'title' => Yii::t('app', 'subcategory'),
                                ]);
                        }
                ],
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
            ],
        ],
    ]); ?>

</div>