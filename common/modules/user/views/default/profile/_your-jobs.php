<div class="reviews left-column col-xs-12 col-sm-12 col-md-12 col-lg-7 tabs-container" role="tabpanel">
        <h1 class="left"><?=Yii::t('app', "Your Jobs")?></h1>
        <p class="user-info right" role="tablist">
            <a href="#jobs-created-tab" aria-controls="jobs-created-tab" class="positive" role="tab" data-toggle="tab"><?=Yii::t('app', "Created").' '?>(<?= $jobsCreatedDataProvider->getTotalCount() ?>)</a>
            <?php //echo 'README.txt для восстановления функциональности'?>
            <a href="#jobs-doned-tab" aria-controls="jobs-doned-tab" class="negative" role="tab" data-toggle="tab"><?=Yii::t('app',"Doned").' '?>(<?= $jobsDonedDataProvider->getTotalCount() ?>)</a>
        </p>
        <div class="clear"></div>
        <div class="tab-content">
            <?= $this->render('_jobs-created', ['dataProvider' => $jobsCreatedDataProvider]) ?>
            <?php //echo $this->render('_jobs-applied', ['dataProvider' => $jobsAppliedDataProvider]) ?>
            <?= $this->render('_jobs-doned', ['dataProvider' => $jobsDonedDataProvider]) ?>
        </div>
</div>
