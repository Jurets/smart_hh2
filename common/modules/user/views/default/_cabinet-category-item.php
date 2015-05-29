<?php
use yii\helpers\Url;
?>
<div class="widget specialties widget-padding spec-wrapping">
    <h1 class="left"><?=Yii::t('app',"My").' '?><span class="red"><?= count($userSpecialities) ?></span><?=' '.Yii::t('app', 'Specialties')?></h1>
    <a href="#" data-sign="Specialites" class="btn btn-average right"><?=Yii::t('app', "ADD A SPECIALTY")?></a>
    <div class="clearfix"></div>
    <div class="specialty-holder text-center">

        <?php if (!is_null($userSpecialities)) { ?>
            <?php foreach ($userSpecialities as $spec) { ?>
                <div class="category-item">
                    <a href="#" class="specialty-item">
                        <div class="icon-items">
                            <img src="<?= Yii::$app->params['images.url'] . '/' . $spec->picture ?>" alt="Moving"/>                                            
                        </div>
                        <p><?= Yii::t('app',$spec->name).' '?></p>                     
                    </a>
                    <a class="delete" href="#"><img src="/images/icon-delete.png" data-spec-dell="<?=$spec->id?>"></a>
                </div>
            <?php } ?>
        <?php } ?>

    </div>
    
    <div data-catDellUrl="<?php echo Url::to(['/user/cat_dell'], true)?>"></div>
