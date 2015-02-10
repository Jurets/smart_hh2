<?php
/* @var $model common\models\UserSocialNetwork */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php
    $form = ActiveForm::begin([
                'action' => Url::to(['/user/cabinet'], true),
    ]);
    ?>
    <?= $form->field($model, 'url', [
        'template' => "{label} {input} \n" . Html::submitButton('Save', ['class' => 'btn btn-average']) . "\n{hint}\n{error}"
    ])->label($model->socialNetwork->title)->input('text', ['style' => 'width:40%;margin-bottom:5px;']) ?>
    <?= $form->field($model, 'social_network_id')->hiddenInput()->label(false) ?>
<?php ActiveForm::end(); ?>
</div>