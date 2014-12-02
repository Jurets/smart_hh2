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
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'rules' => [
            // rules writes in back and front separately
            ],
        ]
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
