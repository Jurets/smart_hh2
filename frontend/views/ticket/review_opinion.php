<?php
use frontend\widgets\ShowMoreListView;
$this->registerJsFile(Yii::$app->params['path.js'].'profile-reviews.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
use common\components\Commonhelper;
?>
<div class="reviews-holder" data-review-opinions="true">
    
    
    <?php 
    echo ShowMoreListView::widget([
        'showMoreBeginTemplate' =>
        Commonhelper::messageParser("<a class='btn btn-width'>SHOW MORE</a>\n<div class='collapse'>", [
            'SHOW MORE' => Yii::t('app', "SHOW MORE"),
        ]),
        'dataProvider' => $reviewOpinionDataProvider,
        'id'=>'reviewOpinion',
        'itemOptions' => ['class' => ''],
        'initialItemsCount' => 4,
        'itemView' => 'review/_review_opinion',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => '<span class="color:#0d3f67;">' .Yii::t('app',"Page").':'. '</span>',
            'nextPageLabel' => '',
        ],
    ])
    ?>
    <?php //echo $this->render('review/_review_opinion') ?>
</div>
