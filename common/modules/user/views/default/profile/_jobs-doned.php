<?php
    use yii\widgets\Pjax;
?>
<div id="jobs-doned-tab" class="reviews-holder tab-pane fade" role="tabpanel">
    <?php Pjax::begin([
        'id' => 'jobs-doned',
        'timeout' => 3000,
        ]); ?>
    <?= \frontend\widgets\ShowMoreListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        'itemView' => '_jobs-created-item',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => Yii::t('app', '<span class="color:#0d3f67;">' . 'Page:' . '</span>'),
            'nextPageLabel' => '',
        ],
    ])
    ?>
    <?php Pjax::end(); ?>
</div>    
