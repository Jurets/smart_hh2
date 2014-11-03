<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\StarRating;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\modules\user\models\User $user
 * @var common\modules\user\models\User $profile
 * @var string $userDisplayName
 */

$this->title = Yii::t('user', 'Registration customer');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-register">

    <h1><?= Html::encode($this->title) ?></h1>

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
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ],
                'enableAjaxValidation' => true,
            ]); ?>

        <?= $form->field($user, 'username') ?>
        <?= $form->field($user, 'newPassword')->passwordInput() ?>
        <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
        <?= $form->field($user, 'email') ?>
        <?= $form->field($profile, 'country_code')->dropDownList(['', 'USA (+1)','Canada ( +1 )']) ?>
        <?= $form->field($profile, 'phone') ?>
        <?= Html::label('Pick language and language knowledge') ?>
        <?= $form->field($userLanguage, 'language')->checkboxList(['ru'=>'Russia','en'=>'English']) ?>
        <?= StarRating::widget(['name' => 'rating_19',
        'pluginOptions' => [
        'stars' => 6,
        'min' => 0,
        'max' => 6,
        'step' => 0.1,
        'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
        'defaultCaption' => '{rating} hearts',
        'starCaptions'=>[]
        ]
        ]);?>
        <?= Html::label('Do you have PayPal?') ?>
        <?= $form->field($profile, 'paypal') ?>
        <?= $form->field($profile, 'adress_mailing') ?>
        <?= $form->field($profile, 'self_description')->textArea(['rows' => 6]) ?>
        <?= $form->field($files, 'file')->fileInput() ?>
        <?= $form->field($files, 'file[]')->fileInput(['multiple' => '']) ?>
        <?= $form->field($files, 'file')->fileInput() ?>

        <?= $form->field($user, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton(Yii::t('user', 'Register'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>

</div>