<div class="reviews left-column col-xs-12 col-sm-12 col-md-12 col-lg-7 tabs-container" role="tabpanel">
        <h1 class="left">Your Jobs</h1>
        <p class="user-info right" role="tablist">
            <a href="#jobs-created-tab" aria-controls="jobs-created-tab" class="positive" role="tab" data-toggle="tab">Created (<?= $jobsCreatedDataProvider->getTotalCount() ?>)</a>
            <a href="#jobs-applied-tab" aria-controls="jobs-applied-tab" class="negative" role="tab" data-toggle="tab">Applied (<?= $jobsAppliedDataProvider->getTotalCount() ?>)</a>
        </p>
        <div class="clear"></div>
        <div class="tab-content">
            <?= $this->render('_jobs-created', ['dataProvider' => $jobsCreatedDataProvider]) ?>
            <?= $this->render('_jobs-applied', ['dataProvider' => $jobsAppliedDataProvider]) ?>
        </div>
</div>
