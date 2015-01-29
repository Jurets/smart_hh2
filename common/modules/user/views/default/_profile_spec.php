<?php
use yii\web\View;
use yii\helpers\Url;
?>
<div class="widget specialties">
            <h1>My <span class="red"><?= count($userSpecialities) ?></span> Specialties</h1>
            <div class="specialty-holder">
<!--                <div class="category-item">
                    <a href="#" class="specialty-item">
                        <div class="icon-items">
                            <img src="/images/categories/moving.png" alt="Moving"/>                                            
                        </div>
                        <p>Moving</p>                     
                    </a>

                </div>-->
            <?php if (!is_null($userSpecialities)) { ?>
                <?php foreach ($userSpecialities as $spec) { ?>
                    <div class="category-item">
                        <a href="#" class="speciality-item">
                            <div class="icon-items">
                                <img src="<?= Yii::$app->params['images.url'] . '/' . $spec->picture ?>" alt="">
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
            </div> 
        </div>
