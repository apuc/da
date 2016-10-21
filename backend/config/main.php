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
    'language' => 'ru-RU',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'news' => [
            'class' => 'backend\modules\news\News',
        ],
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],
        'lang' => [
            'class' => 'backend\modules\lang\Lang',
        ],
        'company' => [
            'class' => 'backend\modules\company\Company',
        ],
        'category_company' => [
            'class' => 'backend\modules\category_company\Category_company',
        ],
        'exchange_rates' => [
            'class' => 'backend\modules\exchange_rates\Exchange_rates',
        ],
        'key_value' => [
            'class' => 'backend\modules\key_value\Key_value',
        ],
        'top_company' => [
            'class' => 'backend\modules\top_company\Top_company',
        ],
        'poster' => [
            'class' => 'backend\modules\poster\Poster',
        ],
        'category_poster' => [
            'class' => 'backend\modules\category_poster\Category_poster',
        ],
        'category_faq' => [
            'class' => 'backend\modules\category_faq\CategoryFaq',
        ],
        'faq' => [
            'class' => 'backend\modules\faq\Faq',
        ],
        'consulting' => [
            'class' => 'backend\modules\consulting\Consulting',
        ],
    ],
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
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
            'baseUrl' => '/secure',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'news' => 'news/news',
                'category' => 'category/category',
                'lang' => 'lang/lang',
                'company' => 'company/company',
                'category_company' => 'category_company/category_company',
                'exchange_rates' => 'exchange_rates/default',
                'key_value' => 'key_value/key_value',
                'poster' => 'poster/poster',
                'category_poster' => 'category_poster/category_poster'
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
