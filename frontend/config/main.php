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
        'msg' => [
            'class' => 'frontend\modules\msg\Msg',
        ],
        'consulting' => [
            'class' => 'frontend\modules\consulting\Consulting',
        ],
        'ajax' => [
            'class' => 'frontend\modules\ajax\Ajax',
        ],
        'rss' => [
            'class' => 'frontend\modules\rss\Rss',
        ],
        'pages' => [
            'class' => 'frontend\modules\pages\Pages',
        ],
        'search' => [
            'class' => 'frontend\modules\search\search',
        ],
        'board' => [
            'class' => 'frontend\modules\board\Board',
        ],
        'personal_area' => [
            'class' => 'frontend\modules\personal_area\PersonalArea',
        ],
        'promotions' => [
            'class' => 'frontend\modules\promotions\Promotions',
        ],
        'converter' => [
            'class' => 'frontend\modules\converter\Converter',
        ],
        'currency' => [
            'class' => 'frontend\modules\currency\Currency',
        ],

        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                // your models
                'frontend\models\sitemap\CategoryNews',
                'frontend\models\sitemap\CategoryCompany',
                'frontend\models\sitemap\News',
                'frontend\models\sitemap\Company',
                'frontend\models\sitemap\CategoryPoster',
                'frontend\models\sitemap\Poster'
                /*'backend\modules\category\models\Category',
                'backend\modules\adsmanager\models\Adsmanager',
                'backend\modules\news\models\News',*/

                // or configuration for creating a behavior
            ],
            'urls'=> [
                // your additional urls
                [
                    'loc' => '/',
                    'lastmod' => '2016-11-06T19:38:59+03:00',
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-news',
                    'lastmod' => '2016-11-06T19:38:59+03:00',
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-company',
                    'lastmod' => '2016-11-06T19:38:59+03:00',
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-poster',
                    'lastmod' => '2016-11-06T19:38:59+03:00',
                    'priority' => 1,
                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'stream' => [
            'class' => 'frontend\modules\stream\Stream',
        ],
        'exchange' => [
            'class' => 'frontend\modules\exchange\Exchange',
        ],
    ],
    'components' => [
        'mymessages' => [
            //Обязательно
            'class'    => 'vision\messages\components\MyMessages',
            //не обязательно
            //класс модели пользователей
            //по-умолчанию \Yii::$app->user->identityClass
            'modelUser' => 'frontend\models\user\UserDec',
            //имя контроллера где разместили action
            'nameController' => '/msg/default',
            //не обязательно
            //имя поля в таблице пользователей которое будет использоваться в качестве имени
            //по-умолчанию username
            'attributeNameUser' => 'username',
            //не обязательно
            //можно указать роли и/или id пользователей которые будут видны в списке контактов всем кто не подпадает
            //в эту выборку, при этом указанные пользователи будут и смогут писать всем зарегестрированным пользователям
            'admins' => [],
            //не обязательно
            //включение возможности дублировать сообщение на email
            //для работы данной функции в проектк должна быть реализована отправка почты штатными средствами фреймворка
            'enableEmail' => true,
            //задаем функцию для возврата адреса почты
            //в качестве аргумента передается объект модели пользователя
            'getEmail' => function($user_model) {
                return $user_model->email;
            },
            //задаем функцию для возврата лого пользователей в списке контактов (для виджета cloud)
            //в качестве аргумента передается id пользователя
            'getLogo' => function($user_id) {
                return '\img\ghgsd.jpg';
            },
            //указываем шаблоны сообщений, в них будет передаваться сообщение $message
            'templateEmail' => [
                'html' => 'private-message-text',
                'text' => 'private-message-html'
            ],
            //тема письма
            'subject' => 'Private message'
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],

        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),

            'clients' => [
                'vkontakte' => [
                    'class'        => 'dektrium\user\clients\VKontakte',
                    'clientId'     => '6213596',
                    'clientSecret' => 'UD0DdeOTDUAEhWntNc5c',
                    'title' => '',
                ],
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => '123823444992959',
                    'clientSecret' => '33c93b3c9c2535be0fcdffd5ad7c2e76',
                    'title' => '',
                ],
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'OtX4znMtlHY9pFfBebY3oyGfb',
                    'consumerSecret' => 'vxHi6mwFxnjCbYbeFlim3l8GDt8Ce078YMW3dfY309EBAhdq5J',
                    'title'          => '',
                ],
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => '136978158391-mp2isb5rqisr158bmmfdnr6j0eqgn629.apps.googleusercontent.com',
                    'clientSecret' => 'LLTc-C8JQQuHYzjbLAm2AV_I',
                    'title'          => '',
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
                'company/<slug>' => 'company/company/view',
                'all-new' => 'news/news',
                'all-company' => 'company/company',
                'news/category/<slug>' => 'news/news/category',
                'news/archive/<date>' => 'news/news/archive',
                'company/category/<slug>' => 'company/company/view-category',
                'poster/<slug>' => 'poster/default/view',
                'all-poster' => 'poster/default/category',
                'all-poster-archive' => 'site/error',
                'poster/category/<slug>' => 'poster/default/single_category',
                'poster-archive/category/<slug>' => 'poster/default/single_archive_category',
                'poster/archive/<date>' => 'poster/default/archive',
                'consulting'=> 'consulting/consulting',
                'consulting/<slug>'=>'/consulting/consulting/view',
                'faq/<slug>'=>'/consulting/consulting/faq',
                'faq-categories/<slugcategory>'=>'/consulting/consulting/faq-categories',
                'faq/<slug>/<faqslug>'=>'/consulting/consulting/faqv',
                'posts/<slug>'=>'/consulting/consulting/posts',
                'posts-categories/<slug>'=>'/consulting/consulting/posts-categories',
                'posts/<slug>/<postslug>'=>'/consulting/consulting/postsv',
                'documents/<slug>'=>'/consulting/consulting/documents',
                'documents-categories/<slug>'=>'/consulting/consulting/documents-categories',
                'documents/<slug>/<catslug>/<postslug>'=>'/consulting/consulting/documentsv',
                'documents/<slug>/<postslug>'=>'/consulting/consulting/documentsv',
                '/document/<slug>'=>'/consulting/consulting/document',
                '/post/<slug>'=>'/consulting/consulting/post',
                '/faq-post/<slug>'=>'/consulting/consulting/faq-post',
                'page/<slug>' => '/pages/default/view',
                //'ajax'=> 'ajax/default',
                //'ajax/send_poll'=> 'ajax/default/send_poll',
                'promotions' => '/promotions/promotions/index',
                'promotions/<slug>' => '/promotions/promotions/view',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                'stream' => 'stream/default/index',
                'stream/<slug>' => 'stream/default/view',


                'obyavleniya' => 'board/default',
                'obyavleniya/<page:\d+>' => 'board/default/index',
                'obyavleniya/category/<slug>' => 'board/default/category-ads',
                'obyavleniya/category/<slug>/<page:\d+>' => 'board/default/category-ads',
                'obyavlenie/<id:\d+>/<slug>/' => 'board/default/view',

            ]
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
