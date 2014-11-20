<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
    ['label' => 'User', 'url' => ['/user']],
    ['label' => 'Customer registration ', 'url' => ['/registration/customer']],
    ['label' => 'Performer registration', 'url' => ['/registration/performer']],
    ['label' => 'All Tickets', 'url' => ['/ticket/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->displayName . ')',
        'url' => ['/user/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
NavBar::end();
?>