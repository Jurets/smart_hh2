<?php
    use yii\widgets\Pjax;
    use common\components\Commonhelper;
?>
<div id="reviews-negative-tab" class="reviews-holder tab-pane fade in" role="tabpanel">
    <?php
    Pjax::begin([
        'id' => 'reviews-negative',
        'timeout' => 3000,
    ]);
    ?>
    <?=
    \frontend\widgets\ShowMoreListView::widget([
        'showMoreBeginTemplate' =>
        Commonhelper::messageParser("<a class='btn btn-width'>SHOW MORE</a>\n<div class='collapse'>", [
            'SHOW MORE' => Yii::t('app', "SHOW MORE"),
        ]),
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        'itemView' => '_reviews-item',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => '<span class="color:#0d3f67;">'.Yii::t('app',"Page").':'.'</span>',
            'nextPageLabel' => '',
        ],
    ])
    ?>
    <?php Pjax::end(); ?>     
</div>    