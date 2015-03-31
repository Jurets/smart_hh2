<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Commonhelper;
?>
<div style="padding-left: 20px;padding-top:15px;">
    <?php echo ($switchWindow === 0) ? Yii::t('app', 'history') . ': ' . Yii::t('app', 'given') : Yii::t('app', 'history') . ': ' . Yii::t('app', 'received'); ?>
    &nbsp; &dollar;
<?= is_null($amountAll) ? 0 : $amountAll ?>
</div>
<?php
echo Html::beginForm(Url::to(['/user/cabinet'], true), 'get', ['class' => 'sort']);
echo Html::dropDownList('ph-kind', isset($_GET['ph-kind']) ? (int) $_GET['ph-kind'] : NULL, [0 => 'given', 1 => 'received'], ['id' => 'switchWindow']);
echo Html::dropDownList('ph-year', isset($_GET['ph-year']) ? (int) $_GET['ph-year'] : NULL, Commonhelper::YearList('2015', '2100'), ['id' => 'yearList']);
echo Html::dropDownList('ph-month', isset($_GET['ph-month']) ? (int) $_GET['ph-month'] : NULL, Commonhelper::MonthList(), ['id' => 'monthList']);
echo Html::submitButton(Yii::t('app', 'SHOW'), ['class' => 'btn btn-average right']);
?>
<div class="payment-history table-imitate">
    <?php
    echo ListView::widget([
        'id' => 'paymentSystem',
        'dataProvider' => $paymentHistoryDataProvider,
        'itemOptions' => ['class' => 'table-row'],
        'itemView' => '_payment',
        'viewParams' => [],
        'summary' => '',
        'pager' => [
            'activePageCssClass' => '',
            'prevPageLabel' => Yii::t('app', '<span style="color:#0d3f67;">' . 'Page:' . '</span>'),
            'nextPageLabel' => '',
        ],
    ]);
    ?>
</div>
<?php
echo Html::endForm()?>