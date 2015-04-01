<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Withdrawal */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Withdrawal',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
