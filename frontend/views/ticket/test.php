
<?php
yii\web\View::registerCssFile(Yii::$app->urlManager->baseUrl.'/js/jquery-ui-1.11.4.custom/jquery-ui.css',[
    'depends' => [yii\bootstrap\BootstrapAsset::className()],
    'position' => yii\web\View::POS_HEAD,
]);
$this->registerJsFile(Yii::$app->params['path.js'].'jquery-ui-1.11.4.custom/'.'jquery-ui.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
$this->registerJsFile(Yii::$app->params['path.js'].'test-modal.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);
?>
<div id='test-modal-1' data-modal-popup-title='<?=Yii::t('app', 'Registration').' '.Yii::t('app', 'Performer')?>'> 
    Hello World Hello World Hello World
    <h1>Hello World Hello World Hello World Hello World Hello World</h1>
</div>

<style>
    .ui-widget-header {
        background: none;
        color: inherit;
        border: 0;
    }
</style>

