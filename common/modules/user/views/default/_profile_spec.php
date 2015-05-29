<?php
use yii\web\View;
use yii\helpers\Url;
?>
<div class="widget specialties">
            <h1><?=Yii::t('app', "My").' '?><span class="red"><?= count($userSpecialities) ?></span><?=' '.Yii::t('app', "Specialties")?></h1>
            <div class="specialty-holder">
            <?php if (!is_null($userSpecialities)) { ?>
                <?php foreach ($userSpecialities as $spec) { ?>
                    <div class="category-item">
                        <a href="#" class="specialty-item">
                            <div class="icon-items">
                                <img src="<?= Yii::$app->params['images.url'] . '/categories/' . $spec->picture ?>" alt="<?=$spec->name?>">
                            </div>
                            <p><?=Yii::t('app',$spec->name)?></p>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
            </div> 
</div>
