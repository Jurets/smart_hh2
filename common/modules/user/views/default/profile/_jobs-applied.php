<?php
    use yii\widgets\Pjax;
?>
<div id="jobs-applied-tab" class="reviews-holder tab-pane fade" role="tabpanel">
    <?php Pjax::begin([
        'id' => 'jobs-applied',
        'timeout' => 3000,
        ]); ?>
    <?= \frontend\widgets\ShowMoreListView::widget([
        'showMoreBeginTemplate' =>
        Commonhelper::messageParser("<a class='btn btn-width'>SHOW MORE</a>\n<div class='collapse'>", [
            'SHOW MORE' => Yii::t('app', "SHOW MORE"),
        ]),
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        //TODO: item view could be changed
        'itemView' => '_jobs-created-item',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => '<span class="color:#0d3f67;">' .Yii::t('app', "Page").':'. '</span>',
            'nextPageLabel' => '',
        ],
    ])
    ?>
    <?php Pjax::end(); ?>
</div>    

