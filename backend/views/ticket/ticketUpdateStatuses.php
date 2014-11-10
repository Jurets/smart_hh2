<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */

$this->title = Yii::t('app', 'Ticket Status Update', [
    'modelClass' => 'Ticket',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_ticketUpdateStatuses', [
        'ticketUpdateStatuses' => $ticketUpdateStatuses,
    ]) ?>

</div>

