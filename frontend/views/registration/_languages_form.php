<?php
use kartik\widgets\DepDrop;
use frontend\helpers\ContactsHelper;
?>

<?php
    $nativeLangList = !empty($userLanguage->language_id) ? $languages : array_merge([''], $languages);
    
    if(isset($nativeLangList[0])){
        $nativeLangList = $languages =  \common\components\Commonhelper::LaPatch();
    }
    if(empty($userLanguage)){
        $userLanguage = \common\components\Commonhelper::LaPatch2();
    }
        
    echo $form->field($userLanguage, 'language_id')->dropDownList($nativeLangList, ['name' => 'languages[0]', 'id' => 'native-lang', 'class' => 'lang-field'])->label('Native language'); 
?>
<div class="optional-languages">
<?php
    $parents = ['native-lang'];
    $optLanguages = ContactsHelper::getOptLanguages(Yii::$app->user->id);
    for($key = 1; $key < count($languages); $key++){
        echo $form->field($userLanguage, 'language_id')->widget(DepDrop::classname(), [
            'data' => !empty($optLanguages) ? array_shift($optLanguages) : [],
            'options' => ['id' => "option-lang-$key", 'name' => "languages[$key]", 'class' => 'lang-field'],
            'pluginOptions' => [
                'depends' => $parents,
                'placeholder' => '',
                'url' => Yii::$app->urlManager->createAbsoluteUrl(['user/option-languages'])
            ]
        ])->label(Yii::t("app",'Add language'));
        $parents[] = "option-lang-$key";
    }
?>
</div>
