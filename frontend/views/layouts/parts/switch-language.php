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
    <option value="en" data-imagesrc="/images/lang/en-small.png" <?=$language == 'en' ? ' selected=""' : ''?>>English</option>
    <option value="ru" data-imagesrc="/images//lang/ru-small.png" <?=$language == 'ru' ? ' selected=""' : ''?>>Русский</option>
    <option value="spa" data-imagesrc="/images/lang/spa-small.png" <?=$language == 'spa' ? ' selected=""' : ''?>>Español</option>
    <option value="por" data-imagesrc="/images/lang/por-small.png" <?=$language == 'por' ? ' selected=""' : ''?>>português</option>
</select>

<div data-langUrlChange="<?=Url::to(['/site/languageswitcher'],true)?>"></div>