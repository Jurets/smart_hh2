<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php 
            $module_id = Yii::$app->controller->module->id;
            $controller_id = Yii::$app->controller->id;
            $action_id = Yii::$app->controller->action->id;
        
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Users', 
                    'url' => ['/user/admin'], 
                    'active' => $module_id == 'user' && $controller_id == 'admin' && $action_id == 'index',
                ];
                $menuItems[] = [
                    'label' => 'Tickets',
                    'url' => ['/ticket/index'],
                    
                ];
                 $menuItems[] = [
                    'label' => 'Ticket status',
                    'url' => ['/ticket/statusupdate'],
                    
                ];
                 $menuItems[] = [
                     'label' => 'Active tickets',
                     'url' => ['/ticket/activetickets'],
                 ];

                 $menuItems[] = [
                     'label' => 'Category',
                     'url' => ['/category'],
                 ];
                $menuItems[] = [
                    'label' => 'Files', 
                    'url' => ['files'], 
                    'active' => $controller_id == 'files',
                ];
                $menuItems[] = [
                    'label' => Yii::t('app', 'Compliants'),
                    'url' => ['/compliant/index'],
                ];
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
