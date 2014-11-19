<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelParent->name, 'url' => ['view', 'id' => $modelParent->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subcategories'), 'url' => ['subcategory', 'id' => $modelParent->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('app', 'Update'), ['sub_update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'weight',
            'active'
        ],
    ]) ?>

</div>
