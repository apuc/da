<?php
namespace backend\widgets;

use common\classes\UserFunction;
use dektrium\user\models\User;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class MainMenuAdmin extends Widget {
    public function run() {
        echo \yii\widgets\Menu::widget(
            [
                'items'           => [
                    [
                        'label'    => 'Пользователи',
                        'url'      => Url::to( [ '/user/admin' ] ),
                        'template' => '<a href="{url}"><i class="fa fa-users"></i> <span>{label}</span></a>',
                        'active'   => Yii::$app->controller->module->id == 'user' || Yii::$app->controller->module->id == 'rbac',
                        'visible'  => UserFunction::hasRoles( [ 'admin' ] ),
                    ],
                    /*[
                        'label' => 'Ссылка 2',
                        'url' => '#'
                    ],*/
                    [
                        'label'    => 'Новости',
                        'items'    => [
                            [
                                'label'   => 'Добавить',
                                'url'     => Url::to( [ '/news/news/create' ] ),
                                'active'  => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'create',
                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label'   => 'Все',
                                'url'     => Url::to( [ '/news' ] ),
                                'active'  => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Категории',
                                'url'     => Url::to( [ '/category' ] ),
                                'active'  => Yii::$app->controller->module->id == 'category' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options'  => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-newspaper-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label'    => 'Компании',
                        'items'    => [
                            [
                                'label'   => 'Добавить',
                                'url'     => Url::to( [ '/company/company/create' ] ),
                                'active'  => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'create',
                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label'   => 'Все',
                                'url'     => Url::to( [ '/company' ] ),
                                'active'  => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Категории',
                                'url'     => Url::to( [ '/category_company' ] ),
                                'active'  => Yii::$app->controller->module->id == 'category_company' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Топ',
                                'url'     => Url::to( [ '/top_company/top_company' ] ),
                                'active'  => Yii::$app->controller->module->id == 'top_company',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options'  => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-building-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label'    => 'Афиша',
                        'items'    => [
                            [
                                'label'   => 'Добавить',
                                'url'     => Url::to( [ '/poster/poster/create' ] ),
                                'active'  => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'create',
                                'visible' => UserFunction::hasRoles( [ 'admin', 'author' ] ),
                            ],
                            [
                                'label'   => 'Все',
                                'url'     => Url::to( [ '/poster' ] ),
                                'active'  => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Категории',
                                'url'     => Url::to( [ '/category_poster' ] ),
                                'active'  => Yii::$app->controller->module->id == 'category_poster' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                        ],
                        'options'  => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-university"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label'    => 'FAQ',
                        'items'    => [
                            [
                                'label'   => 'Добавить',
                                'url'     => Url::to( [ '/faq/faq/create' ] ),
                                'active'  => Yii::$app->controller->module->id == 'faq',
                                'visible' => UserFunction::hasRoles(['admin']),
                            ],
                            [
                                'label'   => 'Категории',
                                'url'     => Url::to( [ '/category_faq/category_faq' ] ),
                                'active'  => Yii::$app->controller->module->id == 'category_faq',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Все',
                                'url'     => Url::to( [ '/faq/faq' ] ),
                                'active'  => Yii::$app->controller->module->id == 'faq',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ]
                        ],
                        'options'  => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-question-circle"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label'    => 'Консалтинг',
                        'items'    => [
                            [
                                'label'   => 'Добавить',
                                'url'     => Url::to( [ '/consulting/consulting/create' ] ),
                                'active'  => Yii::$app->controller->module->id == 'consulting',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ],
                            [
                                'label'   => 'Все',
                                'url'     => Url::to( [ '/consulting/consulting' ] ),
                                'active'  => Yii::$app->controller->module->id == 'consulting',
                                'visible' => UserFunction::hasRoles( [ 'admin' ] ),
                            ]
                        ],
                        'options'  => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-comments"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label'    => 'Курсы валют',
                        'url'      => Url::to( [ '/exchange_rates' ] ),
                        'template' => '<a href="{url}"><i class="fa fa-money"></i> <span>{label}</span></a>',
                        'active'   => Yii::$app->controller->module->id == 'exchange_rates',
                        'visible'  => UserFunction::hasRoles( [ 'admin' ] ),
                    ],
                    [
                        'label'    => 'Переменные',
                        'url'      => Url::to( [ '/key_value' ] ),
                        'template' => '<a href="{url}"><i class="fa fa-ellipsis-h"></i> <span>{label}</span></a>',
                        'active'   => Yii::$app->controller->module->id == 'key_value',
                        'visible'  => UserFunction::hasRoles( [ 'admin' ] ),
                    ],
                    [
                        'label'    => 'Языки',
                        'url'      => Url::to( [ '/lang' ] ),
                        'template' => '<a href="{url}"><i class="fa fa-language"></i> <span>{label}</span></a>',
                        'active'   => Yii::$app->controller->module->id == 'lang',
                        'visible'  => UserFunction::hasRoles( [ 'admin' ] ),
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
                'activateItems'   => true,
                'activateParents' => true,
                'activeCssClass'  => 'active',
                'encodeLabels'    => false,
                /*'dropDownCaret' => false,*/
                'submenuTemplate' => "\n<ul class='treeview-menu' role='menu'>\n{items}\n</ul>\n",
                'options'         => [
                    'class' => 'sidebar-menu',
                ]
            ]
        );
    }
}