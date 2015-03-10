<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FooterContent */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Footer Content',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Footer Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="footer-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
