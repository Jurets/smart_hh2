<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\StarRating;
use kartik\widgets\FileInput;
use yii\captcha\Captcha;
use yii\web\View;

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
        <?= $form->field($profile, 'first_name') ?>            
        <?= $form->field($profile, 'last_name') ?>          
        <?= $form->field($profile, 'country_code')->dropDownList(['', 'USA ( +1 )','Canada ( +1 )']) ?>
        <?= $form->field($profile, 'phone')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => '999-999-9999',
        ]) ?>
        <?php
             echo $form->field($userLanguage, 'language_id')->dropDownList(array_merge([''], $languages), ['name' => 'languages[0]', 'onchange' => 'showOptionLanguage(event, 0)'])->label('Native language'); 
        ?>
        <div class="optional-languages">
        <?php
            foreach ($languages as $key => $value) {
        ?>
        <div class="form-group optional-language-group opt-lang-<?=$key?> opt-lang-hidden">
            <?php
                echo Html::label('Add language', "opt_lang_$key", ['class' => "opt-lang-$key opt-lang-hidden col-lg-2 control-label"]);
            ?>
            <div class="col-lg-3">
                <?php
                    echo Html::dropDownList("languages[$key]", null, array_merge([''], $languages), ['id' => "opt_lang_$key", 'class' => "opt-lang-$key opt-lang-hidden",'onchange' => "showOptionLanguage(event, $key)"]);
                ?>
            </div>
        </div>
        <?php
            }
        ?>
        </div>
        <?php //echo Html::label('Pick language and language knowledge') ?>
        <?php //foreach ($languages as $language) { ?>
        <?php 
//            echo $form->field($userLanguage, 'language['.$language['name'].']')->checkboxList([$language['name']=>Yii::$app->params['languages'][$language['name']]]);
//            echo StarRating::widget(['name' => 'UserLanguage[language]['.$language['name'].'][1]',
//                'pluginOptions' => [
//                    'stars' => 5,
//                    'min' => 0,
//                    'max' => 5,
//                    'step' => 1,
//                    'size' => 'xs',
//                    'defaultCaption' => '{rating} stars',
//                    'starCaptions'=>[],
//                    'showClear' => false,
//                    'showCaption' => false,
//                    'options' => [
//                        'disabled' => true
//                    ],
//                ]
//            ]);
//            echo Html::hiddenInput('UserLanguage[language]['.$language['name'].'][2]',$language['id']);
        ?>
        <?php //} ?>

        <?php //echo Html::label('Do you have PayPal?') ?>
        <?php //echo Html::radioList('checkPaypal',[],['yes','no']) ?>
        <?php //echo $form->field($profile, 'paypal') ?>
        <?php //echo Html::a('Create a PayPal account','https://www.paypal.com') ?>
        <?php //echo Html::label('or input another payment') ?>
        <?php //echo $form->field($profile, 'another_payment') ?>
        
        <?php echo $this->render('_payment_profile', ['paymentProfile'=>$paymentProfile]) ?>

        <?= $form->field($profile, 'zip_mailing') ?>
        <?= $form->field($profile, 'adress_mailing') ?>

        <?= $form->field($profile, 'self_description')->textArea(['rows' => 6]) ?>

        <?= Html::label('Download your photo') ?>
        <?php //echo $form->field($files, 'file[photo]')->fileInput() ?>
        <?php 
            echo FileInput::widget([
                'name'=>'photo',
                'options'=>[
                    'multiple' => false,
                ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                ],
            ]);
        ?>
        <?= Html::label('Download license/certificate') ?>
        <?php 
            echo FileInput::widget([
                'name'=>'cert[]',
                'options'=>[
                    'multiple'=>true,
                ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                ],
            ]);
        ?>

        <?= Html::label('Verification (copy of ID)') ?>
        <?php 
            echo FileInput::widget([
                'name'=>'vercode[]',
                'options'=>[
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                ],
            ]);
        ?>
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

<?php
    $this->registerJs(
            'function showOptionLanguage(event, id){if(event.target.value !== "0"){$(".opt-lang-" + ++id).removeClass("opt-lang-hidden");} else {$(".opt-lang-" + ++id).addClass("opt-lang-hidden").each(function(){this.value = "0";});}}',
            View::POS_END,
            'show-option-language'
        );
?>