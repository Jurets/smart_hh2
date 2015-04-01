<?php
/*
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" 
 * - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
?>
<?php
//$this->registerJsFile(Yii::$app->params['path.js'].'ticket_apply.js', [
//    'depends' => [\yii\web\JqueryAsset::className()],
//]);

$this->registerJs("pp_init();", View::POS_END);

?>
<form method="post" action="<?php echo Url::to(['/user/popup_runtime'], true) ?>" data-render="user-contact">
    <input type="hidden" name="signature" value="PayeeProfile">
    <fieldset>
        <?= Html::hiddenInput('ppid', $dataSet->id) ?>
        <?= Html::dropDownList('choise', (!empty($dataSet->choise)) ? $dataSet->choise : '1', [
            '1' => $dataSet::V1,
            '2' => $dataSet::V2,
            '3' => $dataSet::V3
        ],
                ['id'=>'pp_group_choise','class'=>'sort select', 'style'=>'width:50%;']
        )?>
        <div id='pp_group_1' style="<?=($dataSet->choise===1 || $dataSet->choise=='')?'display:block;':'display:none;'?>">
        <br>
        <?=$dataSet->attributeLabels()['ach_routing_number']?>
        <?= Html::textInput('ach_routing_number', (!empty($dataSet->ach_routing_number))?$dataSet->ach_routing_number:'', [])?>
        <br>
        <?=$dataSet->attributeLabels()['ach_account_number']?>
        <?= Html::textInput('ach_account_number', (!empty($dataSet->ach_account_number))?$dataSet->ach_account_number:'', [])?>
        <br>
        <?=$dataSet->attributeLabels()['ach_account_name']?>
        <?= Html::textInput('ach_account_name', (!empty($dataSet->ach_account_name))?$dataSet->ach_account_name:'', [])?>
        </div>
        <div id='pp_group_2' style="<?=($dataSet->choise===2)?'display:block;':'display:none;'?>">
        <br>
        <?=$dataSet->attributeLabels()['paypal']?><br>
        <?= Html::textInput('paypal', (!empty($dataSet->paypal))?$dataSet->paypal:'', [])?>
        </div>
        <div id='pp_group_3' style="<?=($dataSet->choise===3)?'display:block;':'display:none;'?>">
        <br>
        <?=$dataSet->attributeLabels()['mailing_address']?><br>
        <?= Html::textInput('mailing_address', (!empty($dataSet->mailing_address))?$dataSet->mailing_address:'', [])?>
        <br>
        <?=$dataSet->attributeLabels()['fullname']?><br>
        <?= Html::textInput('fullname', (!empty($dataSet->fullname))?$dataSet->fullname:'', [])?>
        </div>
        <br><br><input type="button" data-submitter="" class="btn btn-average btn-width" value="<?=Yii::t('app', 'SAVE')?>">
    </fieldset>
</form>

