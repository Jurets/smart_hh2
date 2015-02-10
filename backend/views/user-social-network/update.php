<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserSocialNetwork */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Social Network',
]) . ' ' . $model->social_network_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Social Networks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->social_network_id, 'url' => ['view', 'social_network_id' => $model->social_network_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-social-network-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
