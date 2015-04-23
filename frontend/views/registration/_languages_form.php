<?php
use kartik\widgets\DepDrop;
?>

<?php
    echo $form->field($userLanguage, 'language_id')->dropDownList(array_merge([''], $languages), ['name' => 'languages[0]', 'id' => 'native-lang', 'class' => 'lang-field'])->label('Native language'); 
?>
<div class="optional-languages">
<?php
    $parents = ['native-lang'];
    $languages = array_slice($languages, 1, null, true);
    foreach ($languages as $key => $value) {
        echo $form->field($userLanguage, 'language_id')->widget(DepDrop::classname(), [
            'options' => ['id' => "option-lang-$key", 'name' => "languages[$key]", 'class' => 'lang-field'],
            'pluginOptions' => [
                'depends' => $parents,
                'placeholder' => '',
                //'url' => Yii::$app->urlManager->createAbsoluteUrl(['user/option-languages'])
                'url' => \yii\helpers\Url::to(['/user/option-languages'], true)
            ]
        ])->label('Add language');
        $parents[] = "option-lang-$key";
    }
?>
</div>