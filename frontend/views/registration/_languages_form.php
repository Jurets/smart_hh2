<?php
use kartik\widgets\DepDrop;
use yii\helpers\Url;
?>

<?php
    echo $form->field($userLanguage, 'language_id')->dropDownList(array_merge([''], $languages), ['name' => 'languages[1]', 'id' => 'native-lang'])->label('Native language'); 
?>
<div class="optional-languages">
<?php
    $parents = ['native-lang'];
    $languages = array_slice($languages, 1, null, true);
    foreach ($languages as $key => $value) {
        echo $form->field($userLanguage, 'language_id')->widget(DepDrop::classname(), [
            'options' => ['id' => "option-lang-$key", 'name' => "languages[$key]"],
            'pluginOptions' => [
                'depends' => $parents,
                'placeholder' => '',
                'url' => Url::to(['registration/option-languages'])
            ]
        ])->label('Add language');
        $parents[] = "option-lang-$key";
    }
?>
</div>