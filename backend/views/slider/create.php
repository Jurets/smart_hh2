<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Slider',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
