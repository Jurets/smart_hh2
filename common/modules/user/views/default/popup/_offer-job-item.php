<?php
    use yii\helpers\Html;
?>
<div class="task-item info-border">
    <div class="task-info-price">
        <p class="price">&dollar;<span>25</span></p>
        <p class="measurement">week</p>
        <?= Html::checkbox('tickets[]') ?>
    </div>
    <div class="task-info-meta">
        <a  href="#" class="title" data-pjax="0">tilte</a>
        <p class="text">jhfklhas dredsjfksl;j</p>
    </div>
    <div class="clearfix"></div>
    <div class="date-time right">
        2015-13-13 <br/>      
        Moscow, RU
    </div>
    <div class="clearfix"></div>
</div>