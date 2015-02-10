<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSocialNetworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Social Networks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-network-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*
          <?= Html::a(Yii::t('app', 'Create {modelClass}', [
          'modelClass' => 'User Social Network',
          ]), ['create'], ['class' => 'btn btn-success']) ?> */
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'socialNetwork',
                'value' => 'socialNetwork.title'
            ],
            [
                'attribute' => 'user',
                'value' => 'user.email'
            ],
            'url:url',
            'moderate',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete} {solve}',
                'buttons' => [
                    'solve' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::to([
                            'user-social-network/solve',
                            'user_id' => $model->user_id,
                            'social_network_id' => $model->social_network_id,
                                ]),
                                [
                                    'title' => Yii::t('app', 'Solve'),
                                    'data-pjax' => 0,
                        ]);
                    },
                        ],
                    ],
                ],
            ]);
            ?>

</div>
