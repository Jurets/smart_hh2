<?php

use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use common\models\UserLanguage;
use yii\helpers\Html;
?>

<!--<div class="pop-up-wrapper lang-pop-up" style="display: none;">-->
    <div class="pop-up pop-up-edit pop-up-lang lang-pop-up" style='display:none;'>
        <a class="close" href="#">×</a>
        <div class="pop-up-errors"></div>
        <p class="title">Languages</p>

<?php
$form = ActiveForm::begin();
?>

        <fieldset>
<?php
//PopoverX::begin([
//    'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
//    'toggleButton' => ['tag'=>'button', 'class'=>'edit', 'label' => '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'],
//    'header' => '<p class="title">Languages</p>',
//    'closeButton' => ['tag' => 'button'],
//    'options' => [
//        'id' => 'lang-pop-up',
//        'class' => 'pop-up kartik-pop-up',
//    ],
//    'footer' => Html::a('Save', '', [
//                    'title' => Yii::t('yii', 'Close'),
//                    'class' => 'btn btn-average btn-width',
//                    'onclick' => "
//                        var data = {};
//                        data['languages'] = $('.lang-field').map(function(){
//                                return this.value;
//                            }).get();
//                        data['userId'] = '" . Yii::$app->user->id . "';
//                        $.ajax({
//                            type : 'POST',
//                            dataType : 'html',
//                            data : data,
//                            cache : false,
//                            url : 'update-languages',
//                            success : function(response) {
//                                $('#lang-list').html(response);
//                            }
//                        });"
//                    ]
//                )
//]);

echo $this->render('@app/views/registration/_languages_form', ['form' => $form, 'userLanguage' => $userLanguage, 'languages' => $languages]);

//PopoverX::end();

?>

            <a class="btn btn-average btn-width" href="" onclick="
                        var data = {};
                        data['languages'] = $('.lang-field').map(function(){
                                return this.value;
                            }).get();
                        data['userId'] = '<?= Yii::$app->user->id; ?>';
                        $.ajax({
                            type : 'POST',
                            dataType : 'html',
                            data : data,
                            cache : false,
                            url : '<?= Yii::$app->urlManager->createAbsoluteUrl(['user/update-languages']); ?>',
                            success : function(response) {
                                $('#lang-list').html(response);
                            }
                        });">Save</a>
        </fieldset>
<?php
    ActiveForm::end();
?>

    </div>
<!--</div>-->