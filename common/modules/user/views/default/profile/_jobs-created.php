<?php

use yii\widgets\Pjax;
use common\components\Commonhelper;
?>
<div id="jobs-created-tab" class="reviews-holder tab-pane fade in active" role="tabpanel">
    <?php
    Pjax::begin([
        'id' => 'jobs-created',
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

