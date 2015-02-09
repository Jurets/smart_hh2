<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="login-popup-form">
<?php

$form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => ''],
            ],
        ]);
?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe', [
    'template' => '{label}<div class=\"">{input}</div><div>{error}</div>',
])->checkbox()
?>
<?php //echo Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary']) ?>
<?= Html::input('button', 'submit', Yii::t('user', 'Login'), ['class' => 'btn btn-primary'])?>
</div>