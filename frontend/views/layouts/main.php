<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title); ?></title>
        <?php $this->head(); ?>
    </head>
    <body>
        <?php $this->beginBody(); ?>
        
        <div class="basis">
            <?php //echo $this->render('parts/our_header')?>

            <?php if (Yii::$app->user->isGuest) {
                echo $this->render('parts/header');
            }else echo $this->render('parts/header_login')?>

            <!-- main -->
            <div class="main container">
                <div class="header-index col-xs-12 col-sm-12 col-md-12 col-lg-12">

                </div>

                <div class="breadcrumbs">
                    <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                </div>

                <div class="content">
                    <?= $content ?>
                </div>

                <div class="clearfooter">

                </div>

                <?= $this->render('parts/footer')?>
            </div>
        </div>
        <!-- /main -->

    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
