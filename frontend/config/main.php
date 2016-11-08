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
                'poster/category/<slug>' => 'poster/default/single_category',
                'consulting'=> 'consulting/consulting',
                'consulting/<slug>'=>'/consulting/consulting/view',
                //'faq/<faqslug>'=>'/consulting/consulting/faqv',
                'faq/<slug>'=>'/consulting/consulting/faq',
                'faq-categories/<slugcategory>'=>'/consulting/consulting/faq',
                'faq/<slug>/<faqslug>'=>'/consulting/consulting/faqv',

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
