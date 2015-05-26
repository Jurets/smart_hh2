<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            //'errorAction' => 'site/error',
            'errorAction' => 'site/custom-error',
        ],
        'urlManager' => [
            //main params e.g. enablePrettyUrl see in /common/config
            'rules' => [
                'ticket/test/<id:\d+>/test/<test:\d+>' => 'ticket/test', // тестовое правило потом можно удалить
                'ticket/test/<id:\d+>' => 'ticket/test',
                'ticket/<category:.*?>/<city:.*?>' => 'ticket/index',
                'user/zip/<zip:\d+>' => '/user/index',
            ],
        ],
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            ],*/
        'twitter' => [
            'class' => 'richweber\twitter\Twitter',
            // test twitter account https://twitter.com/epaminondas2365
            'consumer_key' => 'WDTEkFoXrDLNuwhzfeqtKOxhQ',                               // set consumer key from your Twitter App
            'consumer_secret' => 'SyjpeBwtQasifkBtWRopwtJ9fNc3FuWrKFq8LarpN1XoAZYIy6',   // set consumer secret key from your Twitter App
            //'callback' => 'YOUR_TWITTER_CALLBACK_URL',
        ],
    ],
    'params' => $params,
];
