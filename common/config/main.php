<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'common\modules\user\components\User',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
        'urlManager' => [
            'rules' => [
            // rules writes in back and front separately
            ],
        ],
        'notification' => [
            'class' => 'common\components\Notification',
        ],
        'paypal' => [
            'class' => 'common\components\Paypal',
            'clientId' => 'you_client_id',
            'clientSecret' => 'you_client_secret',
            'isProduction' => false,
            // This is config file for the PayPal system
            'config' => [
                'http.ConnectionTimeOut' => 30,
                'http.Retry' => 1,
                'mode' => \marciocamello\Paypal::MODE_SANDBOX, // development (sandbox) or production (live) mode
                'log.LogEnabled' => YII_DEBUG ? 1 : 0,
                'log.FileName' => '@frontend/runtime/logs/paypal.log',
                'log.LogLevel' => \marciocamello\Paypal::LOG_LEVEL_FINE,
            ]
        ],
        
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'user' => [ // for addition category
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'common\modules\user\Module',
        // set custom module properties here ...
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            
        ]
    ],
];
