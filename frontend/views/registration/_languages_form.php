<?php
use kartik\widgets\DepDrop;
use frontend\helpers\ContactsHelper;
?>

<?php

    /*language ajax patches*/
    if(empty($languages)){
        $languages = \common\components\Commonhelper::LaPatch();
    }
    if(empty($userLanguage)){
        $userLanguage = \common\components\Commonhelper::LaPatch2();
    }
    $optLanguages = ContactsHelper::getOptLanguages(Yii::$app->user->id);
    echo $form->field($userLanguage, 'language_id')->dropDownList(array_merge([''], $languages), ['name' => 'languages[0]', 'id' => 'native-lang', 'class' => 'lang-field'])->label('Native language'); 
    ?>
<div class="optional-languages">
<?php
    $parents = ['native-lang'];
    $languages = array_slice($languages, 1, null, true);
    foreach ($languages as $key => $value) {
        echo $form->field($userLanguage, 'language_id')->widget(DepDrop::classname(), [
            'data' => !empty($optLanguages) ? array_shift($optLanguages) : [],
            'options' => ['id' => "option-lang-$key", 'name' => "languages[$key]", 'class' => 'lang-field'],
            'pluginOptions' => [
                'depends' => $parents,
                'placeholder' => '',
                'url' => Yii::$app->urlManager->createAbsoluteUrl(['user/option-languages'])
            ]
        ])->label('Add language');
        $parents[] = "option-lang-$key";
    }
?>
</div>