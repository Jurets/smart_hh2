<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserSocialNetwork */

$this->title = $model->social_network_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Social Networks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-network-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'social_network_id' => $model->social_network_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'social_network_id' => $model->social_network_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'social_network_id',
            'user_id',
            'url:url',
            'moderate',
        ],
    ]) ?>

</div>
