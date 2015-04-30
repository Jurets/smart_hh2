<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\StarRating;
use kartik\widgets\FileInput;
use yii\web\View;
?>
<div style="min-width:250px;">
    <?php if ($flash = Yii::$app->session->getFlash("Register-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php else: ?>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
        ]);
        ?>

        <?= $form->field($profile, 'country_code')->dropDownList(['', 'USA ( +1 )', 'Canada ( +1 )']) ?>
        <?=
        $form->field($profile, 'phone')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => '999-999-9999',
        ])
        ?>
        <?= $this->render('_languages_form', ['form' => $form, 'userLanguage' => $userLanguage, 'languages' => $languages]); ?>

        <?php echo $this->render('_payment_profile2', ['paymentProfile' => $paymentProfile]) ?>

        <?= $form->field($profile, 'self_description')->textArea(['rows' => 6]) ?>

        <?= Html::label('Download your photo') ?>
        <?php //echo $form->field($files, 'file[photo]')->fileInput() ?>

        <?php
        echo FileInput::widget([
            'name' => 'photo',
            'options' => [
                'multiple' => false,
            ],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'uploadUrl' => Url::to(['registration/fileupload', 'id' => $user->id], true),
                'uploadAsync' => true,
            ],
        ]);
        ?>
        <?= Html::label('Download license/certificate') ?>
        <?php
        echo FileInput::widget([
            'name' => 'cert[]',
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'uploadUrl' => Url::to(['registration/fileupload', 'id' => $user->id], true),
                'uploadAsync' => true,
            ],
        ]);
        ?>

        <?= Html::label('Verification (copy of ID)') ?>
        <?php
        echo FileInput::widget([
            'name' => 'vercode[]',
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'uploadUrl' => Url::to(['registration/fileupload', 'id' => $user->id], true),
                'uploadAsync' => true,
            ],
        ]);
        ?>
    <input type="hidden" name="signature" value="<?=$user->id?>"> 
    <input type="hidden" name="start" value=""> 
    <br>
    <div class="form-group">
            <div class="col-lg-offset-1 col-lg-10">
                <?= Html::button(Yii::t('user', 'Register'), ['class' => 'btn btn-primary', 'id'=>'submit-button']) ?>
            </div>
        </div>
    
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>