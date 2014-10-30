<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\modules\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-profile">

	<h1><?= Html::encode($this->title) ?></h1>

    <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
        'enableAjaxValidation' => true,
    ]); ?>

    <?php echo $form->field($profile, 'full_name') ?>
    <?php echo $form->field($profile, 'first_name') ?>
    <?php echo $form->field($profile, 'last_name') ?>
    <?php echo $form->field($profile, 'phone') ?>
    <?php echo $form->field($profile, 'adress_mailing') ?>
    <?php echo $form->field($profile, 'adress_billing') ?>
    <?php echo $form->field($profile, 'paypal') ?>
    <?php echo $form->field($profile, 'another_payment') ?>
    <?php echo $form->field($profile, 'self_description') ?>
    <?php echo $form->field($profile, 'photo') ?>
    <?php echo $form->field($profile, 'country_code') ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?php echo Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>