<?php
use yii\helpers\Url;
use common\components\Commonhelper;
?>
<?php
$this->registerJsFile(Yii::$app->params['path.js'].'language-switcher.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
]);

$language = Commonhelper::getLanguage();
?>
<?php // temporary hardcode languages ISO 639-1 ?>
<select id="language">
    <option value="en" data-imagesrc="/images/language-icon.png" <?=$language == 'en' ? ' selected=""' : ''?>>English</option>
    <option value="es" data-imagesrc="/images/language-icon.png" <?=$language == 'es' ? ' selected=""' : ''?>>Español</option>
</select>

<div data-langUrlChange="<?=Url::to(['site/languageswitcher'],true)?>"></div>