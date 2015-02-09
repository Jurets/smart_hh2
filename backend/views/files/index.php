<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                    'modelClass' => 'Files',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'code',
            'size',
            'mimetype',
            // 'description',
            // 'user_id',
            array(
                'attribute' => 'photo',
                //'format' => 'image',
                'format' => 'html',
                //'value' => function ($model, $key, $index, $column) {
                //        return $model->getFileUrl(); 
                //},
                'value' => function ($model, $key, $index, $column) {
                    return Html::img($model->getFileUrl(), ['width' => '150']);
                },
                        'filter' => '',
                    //'headerOptions' => ['width' => '200px'],
                    //'contentOptions' => ['width' => '200px'],
                    //'options' => ['width' => '200px'],
                    ),
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete} {solve}',
                        'buttons' => [
//                            'view' => function($url, $model) {
//                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->urlManager->baseUrl . '/files/view?id=' . $model->id, [
//                                            'title' => Yii::t('app', 'View'),
//                                            'data-pjax' => 0,
//                                ]);
//                            },

                            'solve' => function($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>',
                                            Url::to(['files/solve', 'id'=>$model->id]),
                                                /* Yii::$app->urlManager->baseUrl . '/files/solve?id='.$model->id */ [
                                            'title' => Yii::t('app', 'View'),
                                            'data-pjax' => 0,
                                ]);
                            },
                                ],
                            ],
                        ],
                    ]);
                    ?>

</div>
