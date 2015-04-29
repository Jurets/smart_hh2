<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\web\View;
?>

<div class="user-default-register">
     <?php if ($flash = Yii::$app->session->getFlash("Register-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php else: ?>

        <p><?= Yii::t("user", "Please fill out the following fields to register:") ?></p>

        <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ]); ?>

        <?= $form->field($user, 'username') ?>
        <?= $form->field($user, 'newPassword')->passwordInput() ?>
        <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
        <?= $form->field($user, 'email') ?>
        <?= $form->field($profile, 'first_name') ?>            
        <?= $form->field($profile, 'last_name') ?>
        <?= $form->field($user, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-7">{image}</div><div class="col-lg-7"><br>{input}</div></div>',
                ])
                ?>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::button(Yii::t('user', 'Register'), ['class' => 'btn btn-primary', 'id'=>'submit-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>