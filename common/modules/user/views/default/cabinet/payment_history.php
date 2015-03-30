<?php
use yii\widgets\ListView;
?>
<?php
echo ListView::widget([
    'dataProvider' => $paymentHistoryDataProvider,
    'itemOptions' => ['class' => ''],
    'itemView' => '_payment',
    'viewParams' => [],
    'summary' => '',
    'pager' => [
        'activePageCssClass' => '',
        'prevPageLabel' => Yii::t('app', '<span class="color:#0d3f67;">' . 'Page:' . '</span>'),
        'nextPageLabel' => '',
    ],
]);
?>