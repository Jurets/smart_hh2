<?php
use yii\helpers\Html;

$this->title = Yii::t('app','user') .' '. Yii::t('app','#').' '.$compliants[0]->to_user_id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compliants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->title;
?>
<h1>
    <?php echo Yii::t('app','suspect') .' '. Yii::t('app','#') .$user->username?>
</h1>

<div>
    <?php foreach($compliants as $compliant) { ?>
    <h3><?php echo Yii::t('app', 'From user ') . $compliant->from_user_id ?></h3>
    <h2><?php echo Yii::t('app', 'Message : ')?></h2>
    <p>
        <?php echo $compliant->compliant_message ?>
    </p>
    <hr>
    <?php } ?>
</div>

<div class="row">
        
            <?php echo Html::beginForm(Yii::$app->urlManager->baseUrl . '/compliant/bann?id='.$compliants[0]->to_user_id, 'post') ?>
    <div><?php echo Html::label(Yii::t('app','bannreason'))?></div>
    <div><?php echo Html::textarea('bann-reason', null, ['rows'=>5])?></div>
    <div>
        <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        <?php echo Html::endForm() ?>
    </div>
        
    </div>