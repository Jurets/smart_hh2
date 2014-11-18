<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Complaints');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'ticket_id',
        //'from_user_id',
        [
            'attribute' => $model->attributeLabels()['from_user_id'],
            'value' => function($param){return $param->fromUser->username;},
        ],
        'category',
        'message',
    ],
    ]);
?>