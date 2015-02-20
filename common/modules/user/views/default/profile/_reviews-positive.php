<?php
    use yii\widgets\Pjax;
?>
<div id="reviews-positive-tab" class="reviews-holder tab-pane fade in active" role="tabpanel">
    <?php
    Pjax::begin([
        'id' => 'reviews-positive',
        'timeout' => 3000,
    ]);
    ?>
    <?=
    \frontend\widgets\ShowMoreListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        'itemView' => '_reviews-item',
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