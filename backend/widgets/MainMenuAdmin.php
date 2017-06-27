<?php
namespace backend\widgets;

use backend\modules\comments\models\Comments;
use common\classes\UserFunction;
use dektrium\user\models\User;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class MainMenuAdmin extends Widget
{
    public function run()
    {
        echo \yii\widgets\Menu::widget(
            [
                'items' => [
                    [
                        'label' => 'Пользователи',
                        'url' => Url::to(['/user/admin']),
                        'template' => '<a href="{url}"><i class="fa fa-users"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'user' || Yii::$app->controller->module->id == 'rbac',
                        //'visible'  => UserFunction::hasRoles( [ 'admin' ] ),
                        'visible' => UserFunction::hasPermission(['Пользователи']),
                    ],
                    [
                        'label' => 'Главная',
                        'items' => [
                            [
                                'label' => 'Погода',
                                'url' => Url::to(['/mainpage/mainpage/weather']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->action->id == 'weather',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Фотографии',
                                'url' => Url::to(['/mainpage/mainpage/photos']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->action->id == 'photos',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Развлечения',
                                'url' => Url::to(['/entertainment']),
                                'active' => Yii::$app->controller->module->id == 'entertainment' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Премьера',
                                'url' => Url::to(['/main-premiere']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'main-premiere',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Акции',
                                'url' => Url::to(['/stock/stock']),
                                'active' => Yii::$app->controller->module->id === 'stock' && Yii::$app->controller->action->id === 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Курсы валют',
                                'url' => Url::to(['/exchange_rates']),
                                'active' => Yii::$app->controller->module->id == 'exchange_rates' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Настройки',
                                'url' => Url::to(['/mainpage/mainpage/settings']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->action->id == 'settings',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Новости']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-home"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],

                    [
                        'label' => 'Коментарии',
                        'url' => Url::to(['/comments/comments']),
                        'active' => Yii::$app->controller->module->id == 'comments',
                        'visible' => UserFunction::hasPermission(['Коментарии']),
                        'template' => '<a href="{url}"><i class="fa fa-comments"></i> <span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . Comments::getCountNotModerComments() . '</small></span></a>',

                    ],
                    [
                        'label' => 'Новости',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/news/news/create']),
                                'active' => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/news']),
                                'active' => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category']),
                                'active' => Yii::$app->controller->module->id == 'category' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Главная новость',
                                'url' => Url::to(['/main_new']),
                                'active' => Yii::$app->controller->module->id == 'main_new' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Новости']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-newspaper-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Компании',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/company/company/create']),
                                'active' => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/company']),
                                'active' => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category_company']),
                                'active' => Yii::$app->controller->module->id == 'category_company' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Топ',
                                'url' => Url::to(['/top_company/top_company']),
                                'active' => Yii::$app->controller->module->id == 'top_company',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Развлечения',
                                'url' => Url::to(['/entertainment']),
                                'active' => Yii::$app->controller->module->id == 'entertainment' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Рекомендуем',
                                'url' => Url::to(['/company/company/we-recommend-companies']),
                                'active' => Yii::$app->controller->module->id === 'company' && Yii::$app->controller->action->id === 'we-recommend-companies',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Отзывы',
                                'url' => Url::to(['/company_feedback/company_feedback']),
                                'active' => Yii::$app->controller->module->id === 'company_feedback',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Популярные акции',
                                'url' => Url::to(['/company/company/hot-stock']),
                                'active' => Yii::$app->controller->module->id === 'company' && Yii::$app->controller->action->id === 'hot-stock',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Социальные сети компаний',
                                'url' => Url::to(['/company/soc_company']),
                                'active' => Yii::$app->controller->module->id === 'soc_company' && Yii::$app->controller->action->id === 'soc_company',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Социальные сети',
                                'url' => Url::to(['/company/soc_available']),
                                'active' => Yii::$app->controller->module->id === 'soc_available' && Yii::$app->controller->action->id === 'soc_available',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],

                        'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-building-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Афиша',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/poster/poster/create']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/poster']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category_poster']),
                                'active' => Yii::$app->controller->module->id == 'category_poster' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Главная Афиша',
                                'url' => Url::to(['/main-premiere']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'main-premiere',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Баннер Афиша',
                                'url' => Url::to(['/poster/poster/main-poster']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'main-poster',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Может заинтересовать',
                                'url' => Url::to(['/poster/poster/interested-in']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'interested-in',
                                //'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Слайдер',
                                'url' => Url::to(['/poster/poster/top-slider']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'top-slider',
                                //'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Афиша']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-university"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Консалтинг',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/consulting/consulting/create']),
                                'active' => Yii::$app->controller->module->id == 'consulting' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/consulting/consulting']),
                                'active' => Yii::$app->controller->module->id == 'consulting' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
//                            [
//                                'label'   => 'Добавить категорию',
//                                'url'     => Url::to( [ '/category_posts_consulting/category_posts_consulting/create' ] ),
//                                'active'  => Yii::$app->controller->module->id == 'consulting',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
//                            ],
//                            [
//                                'label'   => 'Добавить статью',
//                                'url'     => Url::to( [ '/posts_consulting/posts_consulting/create' ] ),
//                                'active'  => Yii::$app->controller->module->id == 'consulting',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
//                            ],
//                            [
//                                'label'   => 'Категории статей',
//                                'url'     => Url::to( [ '/category_posts_consulting/category_posts_consulting' ] ),
//                                'active'  => Yii::$app->controller->module->id == 'consulting',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
//                            ],
//                            [
//                                'label'   => 'Статьи',
//                                'url'     => Url::to( [ '/posts_consulting/posts_consulting' ] ),
//                                'active'  => Yii::$app->controller->module->id == 'consulting',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
//                            ]
                        ],
                        'visible' => UserFunction::hasPermission(['Консалтинг']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-comments"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Консалтинг - FAQ',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/faq/faq/create']),
                                'active' => Yii::$app->controller->module->id == 'faq' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/faq/faq']),
                                'active' => Yii::$app->controller->module->id == 'faq' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории FAQ',
                                'url' => Url::to(['/category_faq/category_faq']),
                                'active' => Yii::$app->controller->module->id == 'category_faq' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Консалтинг - FAQ']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-question-circle"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Консалтинг - Статьи',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/posts_consulting/posts_consulting/create']),
                                'active' => Yii::$app->controller->module->id == 'posts_consulting' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все статьи',
                                'url' => Url::to(['/posts_consulting/posts_consulting']),
                                'active' => Yii::$app->controller->module->id == 'posts_consulting' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории статей',
                                'url' => Url::to(['/category_posts_consulting/category_posts_consulting']),
                                'active' => Yii::$app->controller->module->id == 'category_posts_consulting' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Консалтинг - Статьи']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-file-text-o "></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Консалтинг - Дайджест',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/posts_digest/posts_digest/create']),
                                'active' => Yii::$app->controller->module->id == 'posts_digest' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все статьи Дайджест',
                                'url' => Url::to(['/posts_digest/posts_digest']),
                                'active' => Yii::$app->controller->module->id == 'posts_digest' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Категории статей',
                                'url' => Url::to(['/category_posts_digest/category_posts_digest']),
                                'active' => Yii::$app->controller->module->id == 'category_posts_digest' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Консалтинг - Дайджест']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-book"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Опросы',
                        'visible' => UserFunction::hasPermission(['Опросы']),
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/polls/polls/create']),
                                'active' => Yii::$app->controller->module->id == 'polls' && Yii::$app->controller->action->id == 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все опросы',
                                'url' => Url::to(['/polls']),
                                'active' => Yii::$app->controller->module->id == 'polls' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Активный опрос',
                                'url' => Url::to(['/active_poll']),
                                'active' => Yii::$app->controller->module->id == 'active_poll' && Yii::$app->controller->action->id == 'index',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Страницы',
                        //'visible' => UserFunction::hasPermission(['Страницы']),
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/pages/pages/create']),
                                'active' => Yii::$app->controller->module->id === 'pages' && Yii::$app->controller->action->id === 'create',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Все страницы',
                                'url' => Url::to(['/pages/pages']),
                                'active' => Yii::$app->controller->module->id === 'pages',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Группы',
                                'url' => Url::to(['/pages_group/pages_group']),
                                'active' => Yii::$app->controller->module->id === 'pages_group',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-file-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'ВК',
                        //'visible' => UserFunction::hasPermission(['Страницы']),
                        'items' => [
                            [
                                'label' => 'Группы',
                                'url' => Url::to(['/vk/vk_groups']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_groups',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Авторы',
                                'url' => Url::to(['/vk/vk_authors']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_authors',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Поток',
                                'url' => Url::to(['/vk/vk_stream']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_stream',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-vk"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Курсы валют',
                        // 'visible'  => UserFunction::hasPermission( [ 'Опросы' ] ),
                        'items' => [
                            [
                                'label' => 'Типы',
                                'url' => Url::to(['/exchange_rates/exchange_rates_type']),
                                'active' => Yii::$app->controller->id == 'exchange_rates_type',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Валюты',
                                'url' => Url::to(['/exchange_rates/exchange_rates']),
                                'active' => Yii::$app->controller->id == 'exchange_rates',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-usd"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Подписчики',
                        'url' => Url::to(['/subscribe/subscribe']),
                        'template' => '<a href="{url}"><i class="fa fa-share-square-o"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'subscribe',
                        //'visible' => UserFunction::hasPermission(['СЕО']),
                    ],
                    [
                        'label' => 'СЕО',
                        'url' => Url::to(['/seo']),
                        'template' => '<a href="{url}"><i class="fa fa-line-chart"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'seo',
                        'visible' => UserFunction::hasPermission(['СЕО']),
                    ],
                    [
                        'label' => 'Переменные',
                        'url' => Url::to(['/key_value']),
                        'template' => '<a href="{url}"><i class="fa fa-ellipsis-h"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'key_value',
                        'visible' => UserFunction::hasPermission(['Переменные']),
                    ],
                    [
                        'label' => 'Языки',
                        'url' => Url::to(['/lang']),
                        'template' => '<a href="{url}"><i class="fa fa-language"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'lang',
                        'visible' => UserFunction::hasPermission(['Языки']),
                    ],
                    [
                        'label' => 'Ситуации',
                        // 'visible'  => UserFunction::hasPermission( [ 'Опросы' ] ),
                        'items' => [
                            [
                                'label' => 'Статусы',
                                'url' => Url::to(['/situation/situation_status']),
                                'active' => Yii::$app->controller->module->id == 'situation',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label' => 'Блок посты',
                                'url' => Url::to(['/situation/situation']),
                                'active' => Yii::$app->controller->module->id == 'situation',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-car"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'О чем говорят в городе',
                        'url' => Url::to(['/people_talk/people-talk']),
                        // 'visible'  => UserFunction::hasPermission( [ 'Опросы' ] ),
                        //'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Обращения',
                        'url' => Url::to(['/contacting/contacting']),
                         //'visible'  => UserFunction::hasPermission( [ 'Опросы' ] ),
                        //'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'РОСС-ОПТ',
                        // 'visible'  => UserFunction::hasPermission( [ 'Опросы' ] ),
                        'items' => [
                            [
                                'label' => 'Настройки',
                                'url' => Url::to(['/rossopt/default']),
                                'active' => Yii::$app->controller->module->id == 'rossopt',
//                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    /*[
                        'label' => 'Категории',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/category/category/create']),
                                'active' => Yii::$app->controller->module->id == 'category' && Yii::$app->controller->action->id == 'create',
                                'visible' => UserFunction::hasRoles(['admin']),
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/category']),
                                'active' => Yii::$app->controller->module->id == 'category' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles(['admin']),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-flag"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],*/
                ],
                'activateItems' => true,
                'activateParents' => true,
                'activeCssClass' => 'active',
                'encodeLabels' => false,
                /*'dropDownCaret' => false,*/
                'submenuTemplate' => "\n<ul class='treeview-menu' role='menu'>\n{items}\n</ul>\n",
                'options' => [
                    'class' => 'sidebar-menu',
                ],
            ]
        );
    }
}