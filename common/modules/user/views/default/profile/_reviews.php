<div class="reviews left-column col-xs-12 col-sm-12 col-md-12 col-lg-7 tabs-container" role="tabpanel">
            <h1 class="left"><span class="red">
        <?= $positiveReviewDataProvider->getTotalCount() + $negativeReviewDataProvider->getTotalCount()?>
        </span><?=' '.Yii::t('app', "Reviews")?></h1>
    <p class="user-info right" role="tablist"> <?=Yii::t('app', "Show")?>:
        <a href="#reviews-positive-tab" aria-controls="reviews-positive-tab" class="positive" role="tab" data-toggle="tab"><img src="/images/icon-positive.png" alt=""/><?=Yii::t('app',"Positive")?></a>
        <a href="#reviews-negative-tab" aria-controls="reviews-positive-tab" class="negative" role="tab" data-toggle="tab"><img src="/images/icon-negative.png" alt=""/><?=Yii::t('app',"Negative")?></a>
    </p>
    <div class="clear"></div>
    <div class="tab-content">
        <?= $this->render('_reviews-positive', ['dataProvider' => $positiveReviewDataProvider]) ?>
        <?= $this->render('_reviews-negative', ['dataProvider' => $negativeReviewDataProvider]) ?>
    </div>

</div>    