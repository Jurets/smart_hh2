<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserSocialNetwork */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'User Social Network',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Social Networks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-network-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
