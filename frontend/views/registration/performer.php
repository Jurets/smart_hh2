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

$this->title = Yii::t('user', 'Registration performer');
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
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ]); ?>

        <?= $form->field($user, 'username') ?>
        <?= $form->field($user, 'newPassword')->passwordInput() ?>
        <?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>
        <?= $form->field($user, 'email') ?>
        <?= $form->field($profile, 'country_code')->dropDownList(['', 'USA ( +1 )','Canada ( +1 )']) ?>
        <?= $form->field($profile, 'phone') ?>
        <?= Html::label('Pick language and language knowledge') ?>
        <?= $form->field($userLanguage, 'language')->checkboxList(['ru'=>'Russia']) ?>

        <?= StarRating::widget(['name' => 'rating_ru',
                'pluginOptions' => [
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'size' => 'xs',
                    'defaultCaption' => '{rating} stars',
                    'starCaptions'=>[],
                    'showClear' => false,
                    'showCaption' => false,
                    'options' => [
                        'disabled' => true
                    ],
                ]
            ]);?>
        <?= $form->field($userLanguage, 'language')->checkboxList(['en'=>'English']) ?>

        <?= StarRating::widget(['name' => 'rating_en',
                'pluginOptions' => [
                    'stars' => 5,
                    'min' => 0,
                    'max' => 5,
                    'step' => 1,
                    'size' => 'xs',
                    'defaultCaption' => '{rating} stars',
                    'starCaptions'=>[],
                    'showClear' => false,
                    'showCaption' => false,
                    'options' => [
                        'disabled' => true
                    ],
                ]
            ]);?>

        <?= Html::label('Do you have PayPal?') ?>
        <?= Html::radioList('checkPaypal',[],['yes','no']) ?>
        <?= $form->field($profile, 'paypal') ?>
        <?= Html::a('Create a PayPal account','https://www.paypal.com') ?>
        <?= Html::label('or input another payment') ?>
        <?= $form->field($profile, 'another_payment') ?>


        <?= $form->field($profile, 'adress_mailing') ?>

        <?= $form->field($profile, 'self_description')->textArea(['rows' => 6]) ?>

        <?= Html::label('Download your photo') ?>
        <?= $form->field($files, 'file[photo]')->fileInput() ?>

        <?= Html::label('Download license/certificate') ?>
        <?= $form->field($files, 'file[cert]')->fileInput(['multiple' => 'true']) ?>

        <?= Html::label('Verification (copy of ID)') ?>
        <?= $form->field($files, 'file[vercode]')->fileInput() ?>

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