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
        'gridview' => ['class' => 'kartik\grid\Module'],
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
        'posts_consulting' => [
            'class' => 'backend\modules\posts_consulting\Posts_consulting',
        ],
        'category_posts_consulting' => [
            'class' => 'backend\modules\category_posts_consulting\categoryPostsConsulting',
        ],
        'posts_digest' => [
            'class' => 'backend\modules\posts_digest\Posts_digest',
        ],
        'category_posts_digest' => [
            'class' => 'backend\modules\category_posts_digest\Category_posts_digest',
        ],
        'main_new' => [
            'class' => 'backend\modules\main_new\Main_new',
        ],
        'polls' => [
            'class' => 'backend\modules\polls\Polls',
        ],
        'seo' => [
            'class' => 'backend\modules\seo\Seo',
        ],
        'entertainment' => [
            'class' => 'backend\modules\entertainment\Entertainment',
        ],
        'active_poll' => [
            'class' => 'backend\modules\active_poll\Active_poll',
        ],
        'rossopt' => [
            'class' => 'backend\modules\rossopt\Rossopt',
        ],
        'situation' => [
            'class' => 'backend\modules\situation\Situation',
        ],
        'mainpage' => [
            'class' => 'backend\modules\mainpage\Mainpage',
        ],
        'people_talk' => [
            'class' => 'backend\modules\people_talk\PeopleTalk',
        ],
        'stock' => [
            'class' => 'backend\modules\stock\Stock',
        ],
        'company_feedback' => [
            'class' => 'backend\modules\company_feedback\Company_feedback',
        ],
        'pages' => [
            'class' => 'backend\modules\pages\Pages',
        ],
        'pages_group' => [
            'class' => 'backend\modules\pages_group\Pages_group',
        ],
        'vk' => [
            'class' => 'backend\modules\vk\Vk',
        ],
        'contacting' => [
            'class' => 'backend\modules\contacting\Contacting',
        ],
        'subscribe' => [
            'class' => 'backend\modules\subscribe\Subscribe',
        ],
        'comments' => [
            'class' => 'backend\modules\comments\Comments',
        ],
        'services' => [
            'class' => 'backend\modules\services\Services',
        ],
        'tariff' => [
            'class' => 'backend\modules\tariff\Tariff',
        ],
        'site_error' => [
            'class' => 'backend\modules\site_error\SiteError',
        ],
        'region' => [
            'class' => 'backend\modules\region\Region',
        ],
        'city' => [
            'class' => 'backend\modules\city\City',
        ],
        'geobase_ip' => [
            'class' => 'backend\modules\geobase_ip\GeobaseIp',
        ],
        'tags' => [
            'class' => 'backend\modules\tags\Tags',
        ],
        'board' => [
            'class' => 'backend\modules\board\Board',
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
        'request' => [
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
                'seo' => 'seo/default',
                'key_value' => 'key_value/key_value',
                'poster' => 'poster/poster',
                'category_poster' => 'category_poster/category_poster',
                'polls' => 'polls/polls',
                'entertainment' => 'entertainment/default',
                'main-premiere' => 'poster/poster/main-premiere',
                'stock' => 'stock/stock',
            ],
        ],

        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'news/<slug>' => 'news/default/view',
                '' => 'site/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
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
