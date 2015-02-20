<div class="latest-task">
    <h3 id="latestJobs"><?= $caption ?></h3>
    <div data-userID="<?php echo Yii::$app->user->id ?>"></div>
    <div class="tasks-holder row">
        <?php foreach ($columns as $index => $tasks): ?>
            <div class="<?= $index % 2 == 0 ? 'left-column' : 'right-column' ?> col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <?php foreach ($tasks as $task): ?>
                    <?= $this->render('two-column-tasks/_task-item', ['model' => $task]) ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
    <div class="text-center row">
        <a href="<?= $moreButtonLink ?>" class="btn"><?= $moreButtonText ?></a>
    </div>
</div>