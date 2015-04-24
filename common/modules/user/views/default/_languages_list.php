<?php
use yii\helpers\Html;
?>

<div id="lang-list">
    <?= $this->render('_languages_popup', ['languages' => $langList, 'userLanguage' => $userLanguage]); ?>
    <?php
        foreach ($languages as $language) {
    ?>
    <p style="font-weight: <?= empty($language['is_native']) ? 'normal' : 'bold'; ?>">
        <?=Html::encode($language['full_name']); ?>
    </p>
    <?php
        }
    ?>
</div>