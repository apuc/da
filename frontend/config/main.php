<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return \yii\helpers\ArrayHelper::merge([
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
        'currency' => [
            'class' => 'frontend\modules\currency\Currency',
        ],

        'stream' => [
            'class' => 'frontend\modules\stream\Stream',
        ],
        'exchange' => [
            'class' => 'frontend\modules\exchange\Exchange',
        ],
        'shop' => [
            'class' => 'frontend\modules\shop\Shop',
        ],
    ],
    'components' => [
        'cart' => [
            'class' => 'frontend\components\Cart'
        ],
        'session'=>[
            'timeout' => 12*60*60,
        ],
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
                    'clientId'     => '393139631141463',
                    'clientSecret' => 'da146fed3a481f1b6e92a1dd8e58d559',
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
            //'class' => 'frontend\components\LangRequest',
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
                [
                    'pattern' => 'company/company/update',
                    'route' => 'company/company/update',
                ],
                [
                    'pattern' => 'company/company/create',
                    'route' => 'company/company/create',
                ],
                [
                    'pattern' => 'company/company/delete',
                    'route' => 'company/company/delete',
                ],
                [
                    'pattern' => 'company/set-tariff-company/<id:\d+>',
                    'route' => 'company/default/set-tariff-company',
                ],
                [
                    //'pattern' => 'company/set-tariff-company/<id:\d+>',
                    'pattern' => 'company/to-order/<companyId:\d+>/<tariffId:\d+>/<price:\d+>',
                    'route' => 'company/default/to-order',
                ],
                [
                    //'pattern' => 'company/set-tariff-company/<id:\d+>',
                    'pattern' => 'company/success-tariff',
                    'route' => 'company/default/success-tariff',
                ],
                'company/category/<slug>' => 'company/company/view-category',
                'company/<slug>/<page>' => 'company/company/view',
                'company/<slug>' => 'company/company/view',
                'all-new' => 'news/news',
                'all-company' => 'company/company',
                'news/category/<slug>' => 'news/news/category',
                'news/archive/<date>' => 'news/news/archive',

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

                'stream' => 'stream/default/index',
                'stream/<slug>' => 'stream/default/view',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                ['pattern' => 'news-sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                ['pattern' => 'company-sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                ['pattern' => 'poster-sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                ['pattern' => 'stream-sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],

                'obyavleniya' => 'board/default',
                'obyavleniya/<page:\d+>' => 'board/default/index',
                'obyavleniya/category/<slug>' => 'board/default/category-ads',
                'obyavleniya/category/<slug>/<page:\d+>' => 'board/default/category-ads',
                'obyavlenie/<id:\d+>/<slug>/' => 'board/default/view',

                'currency/converter' => 'currency/default/converter',
                'currency/detail-coin' => '/currency/default/detail-coin',
                'finance' => 'currency/default/all',
                [
                    'class' => \frontend\components\ShopRule::class,
                ],
                //'shop/<action:cart|order>'=>'shop/shop/<action>',
                'shop/shop/add-in-cart'=>'shop/shop/add-in-cart',
                'shop/shop/price-count'=>'shop/shop/price-count',
                'shop/products/create'=>'shop/products/create',
                'shop/products/delete'=>'shop/products/delete',
                'shop/products/update'=>'shop/products/update',
                'shop/product/delete-img'=>'shop/products/delete-img',
                'shop/products/general-modal'=>'shop/products/general-modal',
                'shop/products/show-category'=>'shop/products/show-category',
                'shop/products/show-parent-modal-category' => 'shop/products/show-parent-modal-category',
                'shop/products/show-category-end' => 'shop/products/show-category-end',
                'shop/products/show-additional-fields' => 'shop/products/show-additional-fields',
                'shop/product/<slug>'=>'shop/shop/show',
                'shop/<category:.+>'=>'shop/shop/category',
                'shop'=>'shop/default/index',
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
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
    ],
    'params' => $params,
],
    require(__DIR__ . '/sitemap.php')
);
