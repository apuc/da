<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'ipgeobase' => [
            'class' => 'himiklab\ipgeobase\IpGeoBase',
            'useLocalDB' => true,
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@', '?'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '',
                    'basePath' => '@frontend/web',
                    'path' => 'media/upload',
                    'name' => 'Изображения',
                ],
            ],
            'watermark' => [
                'source' => __DIR__ . '/logo.png', // Path to Water mark image
                'marginRight' => 5, // Margin right pixel
                'marginBottom' => 5, // Margin bottom pixel
                'quality' => 95, // JPEG image save quality
                'transparency' => 70, // Water mark image transparency ( other than PNG )
                'targetType' => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200 // Target image minimum pixel size
            ]
        ]
    ],

    'modules' => [
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'registration' => '\frontend\controllers\user\RegUserController',
                'recovery' => '\frontend\controllers\user\RecoveryController',
                'settings' => [
                    'class' => '\frontend\controllers\user\SettingController',
                    'layout' => '@frontend/views/layouts/personal_area',
                ],
                'security' => [
                    'class' => \dektrium\user\controllers\SecurityController::className(),
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_BEFORE_LOGIN => function ($e) {
                        $cart = !\Yii::$app->cart->isEmpty() ? \Yii::$app->cart->getCart() : null;
                    },
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGIN => function ($e) {
                        if (!empty($cart)) \Yii::$app->cart->setCart($cart);
                    },
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_BEFORE_LOGOUT => function ($e) {
                        $cart = !\Yii::$app->cart->isEmpty() ? \Yii::$app->cart->getCart() : null;
                    },
                    'on ' . \dektrium\user\controllers\SecurityController::EVENT_AFTER_LOGOUT => function ($e) {
                        if (!empty($cart)) \Yii::$app->cart->setCart($cart);
                    },
                ],
            ],
            'modelMap' => [
                'RegistrationForm' => '\frontend\models\user\RegUserForm',
                'RecoveryForm' => '\frontend\models\user\RecoveryForm',
                'ResendForm' => '\frontend\models\user\ResendForm',
                'User' => '\frontend\models\user\UserDec',
            ],
            'enableUnconfirmedLogin' => true,
            'enableGeneratingPassword' => false,
            'enableConfirmation' => true,
            'enableFlashMessages' => false,
            'confirmWithin' => 86400,
            'cost' => 12,
            'admins' => ['admin'],
            'mailer' => [
                'sender' => ['noreply@da-info.pro' => 'DA-Info'], // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject' => 'Добро пожаловать',
                'confirmationSubject' => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject' => 'Recovery subject',
            ],
        ],
    ],
//    'aliases' => [
//        '@bower' => '@vendor/bower-asset',
//        '@npm'   => '@vendor/npm-asset'
//    ]

    /*'catchAll' => [
        'offline/notice',
        'statusCode' => '123',
    ],*/
];
