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
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<br><div class=\"col-lg-7\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                ],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ]); ?>

        <div class="form-group checkbox-register-block">
        <?php echo Yii::t('app', 'What do you want?') ?>
        <br>
        <input id="user-role-customer" type="radio" name="user_role" value="customer" checked="">
        <label for="user-role-customer"><?=Yii::t('app', 'Post a job')?></label>
        <br>
        <input id="user-role-performer" type="radio" name="user_role" value="performer">
        <label for="user-role-performer"><?=Yii::t('app', 'Become a helper (any helper may post a job)')?></label>
        <br>
        </div>
        
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