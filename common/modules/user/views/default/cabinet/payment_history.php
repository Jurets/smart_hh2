<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Commonhelper;
?>
<div style="padding-left: 20px;padding-top:15px;">
<?php echo ($switchWindow === 0) ? Yii::t('app','history') .': '.Yii::t('app', 'given') : Yii::t('app','history') .': '. Yii::t('app', 'received');?>
</div>
<?php
echo Html::beginForm(Url::to(['/user/cabinet'],true), 'get', ['class'=>'sort']);
echo Html::dropDownList('payment_history_kind', isset($_GET['payment_history_kind'])?(int)$_GET['payment_history_kind'] : NULL, [0=>'given', 1=>'received'], ['id'=>'switchWindow']);
echo Html::dropDownList('payment_history_year', isset($_GET['payment_history_year'])?(int)$_GET['payment_history_year'] : NULL, Commonhelper::YearList('2015', '2100'), ['id'=>'yearList']);
echo Html::dropDownList('payment_history_month', isset($_GET['payment_history_month'])?(int)$_GET['payment_history_month'] : NULL, Commonhelper::MonthList(), ['id'=>'monthList']);
echo Html::submitButton(Yii::t('app', 'SHOW'),['class'=>'btn btn-average right']);
echo ListView::widget([
    'id' => 'paymentSystem',
    'dataProvider' => $paymentHistoryDataProvider,
    'itemOptions' => ['class' => ''],
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
<?php echo Html::endForm()?>