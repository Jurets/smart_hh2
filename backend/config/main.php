<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
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
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            //main params e.g. enablePrettyUrl see in /common/config
            'rules' => [
                // your rules go here
            
                'indexmanager' => 'footer-content',
                'indexmanager/create' => 'footer-content/create',
                'indexmanager/update' => 'footer-content/update',
                'indexmanager/delete' => 'footer-content/delete',
                'indexmanager/index' => 'footer-content/index',
                'indexmanager/slider' => 'footer-content/slider',
            ],
            // ...
        ],
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            ],*/
    ],
    'modules' => [],
    'params' => $params,
];
