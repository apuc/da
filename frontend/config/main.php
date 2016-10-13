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
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'mainpage' => [
            'class' => 'frontend\modules\mainpage\Mainpage',
        ],
        'news' => [
            'class' => 'frontend\modules\news\News',
        ],
        'company' => [
            'class' => 'frontend\modules\company\Company',
        ],
        'poster' => [
            'class' => 'frontend\modules\poster\Poster',
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
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
        'request'      => [
            'baseUrl' => '',
            'class' => 'frontend\components\LangRequest',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'mainpage/default',
                'news' => 'news/default',
                'all-news/<page:\d+>/<per-page:\d+>' => 'news/news/index',
                'news/<slug>' => 'news/default/view',
                'company' => 'company/default',
                'company/<slug>' => 'company/default/view',
                'all-new' => 'news/news',
                'all-company' => 'company/company',
                'news/category/<slug>' => 'news/news/category',
                'news/archive/<date>' => 'news/news/archive',
                'company/category/<slug>' => 'company/company/category',
                'poster/<slug>' => 'poster/default/view',
                'all-poster' => 'poster/default/category',
                'poster/category/<slug>' => 'poster/default/single_category'
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'language' => 'ru-RU',
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/languages',
                ],
            ],
        ],
    ],
    'params' => $params,
];
