<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => array(
//            'class' => 'yii\web\UserDec',
//            'identityClass' => 'app\models\user\UserDec',
//            'enableSession' => false,
            'class' => 'frontend\models\user\UserDec',
            'identityClass' => 'dektrium\user\models\User',
            //'enableAutoLogin' => true,
        ),
        'session' => [
            'class' => 'yii\web\Session'
        ],
    ],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacConsoleModule',
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'urlRules' => [],
            'enableUnconfirmedLogin' => true,
            'enableRegistration' => false,
            'confirmWithin' => 21600,
            'cost' => 12,
        ],
    ],
    'params' => $params,
];
