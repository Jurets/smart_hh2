<?php
    use yii\widgets\Pjax;
?>
<div id="jobs-applied-tab" class="reviews-holder tab-pane fade" role="tabpanel">
    <?php Pjax::begin([
        'id' => 'jobs-applied',
        'timeout' => 3000,
        ]); ?>
    <?= \common\modules\user\widgets\JobsListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        //TODO: item view could be changed
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

