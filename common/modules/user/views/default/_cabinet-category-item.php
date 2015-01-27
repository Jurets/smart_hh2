<div class="widget specialties widget-padding">
    <h1 class="left">My <span class="red"><?= count($userSpecialities) ?></span> Specialties</h1>
    <a href="#" data-sign="Specialites" class="btn btn-average right">ADD A SPECIALTY</a>
    <div class="clearfix"></div>
    <div class="specialty-holder text-center">

        <?php if (!is_null($userSpecialities)) { ?>
            <?php foreach ($userSpecialities as $spec) { ?>
                <div class="category-item">
                    <a href="#" class="specialty-item">
                        <div class="icon-items">
                            <img src="<?= Yii::$app->params['images.url'] . '/' . $spec->picture ?>" alt="Moving"/>                                            
                        </div>
                        <p><?= $spec->name ?></p>                     
                    </a>
                    <a class="delete" href="#"><img src="/images/icon-delete.png"/></a>
                </div>
            <?php } ?>
        <?php } ?>

    </div>
