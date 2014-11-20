<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Complaints');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'ticket_id',
        [
            'attribute' => Yii::t('app', 'Title'),
            'value' => function($p) {
                return $p->ticket->title;
            }
        ],
        [
            'attribute' => Yii::t('app', 'Description'),
            'value' => function($p) {
                return substr($p->ticket->description, 0, 255) . ' ...';
            }
        ],
        [

            'class' => 'yii\grid\ActionColumn',
            'template' => '{info} {disban}',
            'buttons' => [
                'info' => function($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->urlManager->baseUrl . '/complaint/info?id=' . $model->ticket_id, [
                                'title' => Yii::t('app', 'Info'),
                                'data-pjax' => 0,
                    ]);
                },
                        'disban' => function($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', Yii::$app->urlManager->baseUrl . '/complaint/disban?id=' . $model->ticket_id, [
                                'title' => Yii::t('app', 'Disban'),
                                'data-confirm' => Yii::t('app', 'Release this ticket?'),
                                'data-pjax' => 0,
                    ]);
                }
                    ],
        ],
    ],
    ]);
    ?>