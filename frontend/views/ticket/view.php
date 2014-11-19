<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

yii\web\View::registerJsFile(Yii::$app->urlManager->baseUrl.'/js/complain_script.js',[
    'depends'=> [\yii\web\JqueryAsset::className()],
    'position'=>  yii\web\View::POS_END,
]);
yii\web\View::registerCssFile(Yii::$app->urlManager->baseUrl.'/css/complain.css',[
    'depends' => [yii\bootstrap\BootstrapAsset::className()],
    'position' => yii\web\View::POS_HEAD,
]);

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) 
        ?>
        <?php Modal::begin([
            'header' => '<h2>'.Yii::t('app','Send Complaint').'</h2>',
            'toggleButton' => [
                'label' => Yii::t('app','Complain'),
                'class' => 'btn btn-danger',
             ],
            'size' => Modal::SIZE_LARGE,
        ])?>
    <div id="modal_complain_content">
        <?php echo Html::beginForm('complain','post', ['id'=>'complain_sender']) ?>
        <?php echo Html::label(Yii::t('app','Complain Cathegory')) ?>
        <?php echo Html::dropDownList('complain_category','', [
            $complain->complains[0] => Yii::t('app',$complain->complains[0]),
            $complain->complains[1] => Yii::t('app',$complain->complains[1]),
            $complain->complains[2] => Yii::t('app',$complain->complains[2]),
            $complain->complains[3] => Yii::t('app',$complain->complains[3]),
        ],['class'=>'btn btn-default']) ?>
        <hr>
        <?php echo Html::label(Yii::t('app', 'Complain Message'))?>
        <br>
        <?php echo Html::textarea('complaint_message', '', ['row'=>5])?>
        <br>
        <?php echo Html::button(Yii::t('app','Send'),['id'=>'complain_send', 'class' => 'btn btn-success']) ?>
        <?php //captcha if needed most implement ?>
        <?php echo Html::endForm() ?>
    </div>
        <?php Modal::end()?>     
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'id_category',
            'description:ntext',
            'title',
            'price',
            'created',
            'is_turned_on',
            'system_key',
            'status',
            'is_time_enable:datetime',
            'start_day',
            'finish_day',
            'comment:ntext',
            'is_positive',
            'rate',
        ],
    ]) ?>

</div>

<div style="display:none;">
    <p id="param1"><?php echo Yii::$app->urlManager->baseUrl .'/ticket/complain'?></p>
    <p id="param2"></p>
    <p id="param3"></p>
</div>