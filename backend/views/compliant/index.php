<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Compliants');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'date_created',
        [
            'attribute' => 'User Name',
            'value' => function($ds){ return $ds->toUser->username;},
        ],
        [
            'attribute' => 'Email',
            'value' => function($m){ return $m->toUser->email;},
        ],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{show} {bann}',
        'buttons' => [
          'bann' => function($url, $model){
                return Html::a('<span class="glyphicon glyphicon-ban-circle"></span>', 
                      Yii::$app->urlManager->baseUrl .'/compliant/bann?id='.$model->to_user_id,
                        [
                                    'title' => Yii::t('app', 'Bann'),
                                    'data-confirm' => Yii::t('app', 'Are you sure to bann user?'),
                                    'data-pjax' => 0,
                        ]);
           },
         'show' => function($url, $model){
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                      Yii::$app->urlManager->baseUrl .'/compliant/show?id='.$model->to_user_id,
                        [
                                    'title' => Yii::t('app', 'Show'),
                                    'data-pjax' => 0,
                        ]);
           }
        ],
      ],
    ],
]);
?>