<?php

use yii\helpers\Html;

?>

<div class="divTicketInformation">
    <p><?php echo Html::a('Detail information', array('view', 'id' => $model->id)); ?></p>
    <p>Title: <?php echo $model->title; ?></p>
    <p class="description">Description: <?php echo $model->description; ?></p>
    <p>Price: <?php if (isset($model->price)) {
        echo $model->price;
    } ?> </p>
    <p>Created: <?php if (isset($model->created)) {
        echo $model->created;
    } ?></p>
    <p>Start day: <?php if (isset($model->start_day)) {
            echo $model->start_day;
        } else echo '-'; ?></p>
    <p>Finish day: <?php if (isset($model->finish_day)) {
            echo $model->finish_day;
        } else echo '-'; ?></p>
    <p>Status: <?php if (isset($model->status)) {
        echo $model->status;
    } ?></p>
    <p> <?php echo Html::dropDownList('target', '', $list, array('class' => 'target-lang')) ?>
        <?php echo Html::dropDownList('target', 'pt', $list, array('class' => 'select-lang')) ?>
        <button class="btn btn-inverse translate">Translate description </button>
    </p>   
</div>
