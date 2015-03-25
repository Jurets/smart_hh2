<?php
use frontend\widgets\ShowMoreListView;
$this->registerJsFile(Yii::$app->params['path.js'].'profile-reviews.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);

?>
<div class="reviews-holder" data-review-opinions="true">
    
    
    <?php 
    echo ShowMoreListView::widget([
        'dataProvider' => $reviewOpinionDataProvider,
        'id'=>'reviewOpinion',
        'itemOptions' => ['class' => ''],
        'initialItemsCount' => 4,
        'itemView' => 'review/_review_opinion',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => Yii::t('app', '<span class="color:#0d3f67;">' . 'Page:' . '</span>'),
            'nextPageLabel' => '',
        ],
    ])
    ?>
    <?php //echo $this->render('review/_review_opinion') ?>
</div>