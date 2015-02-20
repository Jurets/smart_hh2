<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Registration customer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if ($flash = Yii::$app->session->getFlash("Register-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form','enableClientValidation' => true,]); ?>
            <?= $form->field($user, 'username') ?>
            <?= $form->field($user, 'newPassword')->passwordInput() ?>
            <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
            <?= $form->field($user, 'email') ?>
            <?= $form->field($profile, 'first_name') ?>            
            <?= $form->field($profile, 'last_name') ?>            
            <?= $form->field($profile, 'phone') ?>
            <?= $form->field($profile, 'zip_billing') ?>
            <?= $form->field($profile, 'adress_billing')->textarea(['rows'=>4]) ?>
            <?= $form->field($user, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
 <?php endif; ?>
</div>