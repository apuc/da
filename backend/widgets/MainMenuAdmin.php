<?php
namespace backend\widgets;

use backend\modules\comments\models\Comments;
use backend\modules\company_feedback\models\CompanyFeedback;
use backend\modules\contacting\models\Contacting;
use backend\modules\products\models\Products;
use backend\modules\site_error\models\SiteError;
use backend\modules\vk\models\VkStream;
use common\classes\CompanyFunction;
use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\GooglePlusPosts;
use common\models\db\News;
use common\models\db\Poster;
use dektrium\user\models\User;
use frontend\modules\board\models\BoardFunction;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\models\db\Stock;

class MainMenuAdmin extends Widget
{
    public function run()
    {
        $url = Yii::$app->params['site-api'] . '/ads/count-moder-ads?api_key=' . Yii::$app->params['api-key'];
        if (BoardFunction::isDomainAvailible($url)){
            $countAds = BoardFunction::fileGetContent($url);
            $countAds = json_decode($countAds);
        } else {
            $countAds = '?!?';
        }

        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);


        $userId = Yii::$app->user->id;

        $companyCountModer = CompanyFunction::getCompanyCountModer();
        $CompanyTariffOrderCount = CompanyFunction::getCompanyOrderTarif();
        $countNews = News::find()->where(['status' => 1])->count();
        $countPoster = Poster::find()->where(['status' => 1])->count();
        $countError = SiteError::find()->count();
        $countPromotions = Stock::find()->where(['status' => 1])->count();
        $countFeedback = CompanyFeedback::find()->where(['status' => 0])->count();
        $countModerStream = VkStream::find()->where(['status' => 0])->count();

        $countPublishStreamQuery = VkStream::find()
            ->where(['status' => 2]);
        $countPublishedStreamQuery = VkStream::find()
            ->where(['status' => 1])
            ->andWhere(['<', 'dt_publish', time()]);
        $countBasketStreamQuery = VkStream::find()
            ->where(['status' => 3]);
        $countDefferedStreamQuery = VkStream::find()->where(['status' => 4]);
        $countDefferedStreamGoogleQuery = GooglePlusPosts::find()->where(['status' => 4]);


        if(isset($role['Редактор парсинга']))
        {
            $countPublishStreamQuery->andWhere(['user_id' => $userId]);
            $countPublishedStreamQuery->andWhere(['user_id' => $userId]);
            $countBasketStreamQuery->andWhere(['user_id' => $userId]);
            $countDefferedStreamQuery->andWhere(['user_id' => $userId]);
        }

        $countPublishStream = $countPublishStreamQuery->count();
        $countPublishedStream = $countPublishedStreamQuery->count();
        $countBasketStream = $countBasketStreamQuery->count();
        $countDefferedStream = $countDefferedStreamQuery->count();
        $countDefferedStreamGoogle = $countDefferedStreamGoogleQuery->count();
        $countContacting = Contacting::find()->where(['status' => 0])->count();


        $countProducts = Products::find()->where(['status' => 0, 'type' => Products::TYPE_PRODUCT])->count();
        $countService = Products::find()->where(['status' => 0, 'type' => Products::TYPE_SERVICE])->count();

        echo \yii\widgets\Menu::widget(
            [
                'items' => [
                    [
                        'label' => 'Пользователи',
                        'url' => Url::to(['/user/admin']),
                        'template' => '<a href="{url}"><i class="fa fa-users"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'user' || Yii::$app->controller->module->id == 'rbac',
                        'visible' => UserFunction::hasPermission(['Пользователи']),
                    ],
                    [
                        'label' => 'Главная',
                        'items' => [
                            [
                                'label' => 'Погода',
                                'url' => Url::to(['/mainpage/mainpage/weather']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->action->id == 'weather',
                            ],
                            [
                                'label' => 'Фотографии',
                                'url' => Url::to(['/mainpage/photo']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->id == 'photo',
                            ],
                            [
                                'label' => 'Развлечения',
                                'url' => Url::to(['/entertainment']),
                                'active' => Yii::$app->controller->module->id == 'entertainment' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Премьера',
                                'url' => Url::to(['/mainpage/main-premiere']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->id == 'main-premiere',
                            ],

                            [
                                'label' => 'Курсы валют',
                                'url' => Url::to(['/exchange_rates']),
                                'active' => Yii::$app->controller->module->id == 'exchange_rates' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Настройки',
                                'url' => Url::to(['/mainpage/mainpage/settings']),
                                'active' => Yii::$app->controller->module->id == 'mainpage' && Yii::$app->controller->action->id == 'settings',
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Главная']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-home"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Акции',
                        'url' => Url::to(['/stock/stock']),
                        'template' => '<a href="{url}"><i class="fa fa-credit-card"></i> <span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countPromotions . '</small></span></a>',
                        'active' => Yii::$app->controller->module->id === 'stock',
                        'visible' => UserFunction::hasPermission(['Акции']),
                    ],
                    [
                        'label' => 'Коментарии',
                        'url' => Url::to(['/comments/comments']),
                        'active' => Yii::$app->controller->module->id == 'comments',
                        'visible' => UserFunction::hasPermission(['Коментарии']),
                        'template' => '<a href="{url}"><i class="fa fa-comments"></i> <span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . Comments::getCountNotModerComments() . '</small></span></a>',

                    ],
                    [
                        'label' => 'Объявления',
                        'url' => Url::to(['/board/default']),
                        'active' => Yii::$app->controller->module->id == 'board',
                        'visible' => UserFunction::hasPermission(['Объявления']),
                        'template' => '<a href="{url}"><i class="fa fa-dashboard"></i> <span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countAds . '</small></span></a>',

                    ],
                    [
                        'label' => 'Новости',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/news/news/create']),
                                'active' => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'create',
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/news']),
                                'active' => Yii::$app->controller->module->id == 'news' && Yii::$app->controller->action->id == 'index',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countNews . '</small></span></a>',
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category']),
                                'active' => Yii::$app->controller->module->id == 'category' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasPermission(['Категории новостей']),
                            ],
                            [
                                'label' => 'Главная новость',
                                'url' => Url::to(['/main_new']),
                                'active' => Yii::$app->controller->module->id == 'main_new' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasPermission(['Главная новость']),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Новости']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        /*'template' => '<a href="#"><i class="fa fa-newspaper-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',*/

                        'template' => '
                            <a href="#">
                                    <i class="fa fa-building-o"></i> 
                                    <span>{label}</span> 
                                      <span class="pull-right-container">
                                          <span class="label bg-red pull-right">'. $countNews .'</span>
                                      </span>  
                            </a>',

                    ],
                    [
                        'label' => 'Shop',
                        'items' => [
                            [
                                'label' => 'Вам понравится',
                                'url' => Url::to(['/company/shop/categories']),
                                'active' => Yii::$app->controller->module->id == 'shop' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Баннер',
                                'url' => Url::to(['/company/shop/change-banner']),
                                'active' => Yii::$app->controller->module->id == 'shop' && Yii::$app->controller->action->id == 'index',
                            ],
                        ],

                        'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#">
                                    <i class="fa fa-shopping-cart"></i> 
                                    <span>{label}</span>
                            </a>',
                    ],
                    [
                        'label' => 'Компании',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/company/company/create']),
                                'active' => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'create',
                            ],
                            [
                                'label' => 'Заявки',
                                'url' => Url::to(['/company/order-tariff/index']),
                                'active' => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'index',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-yellow">' . $CompanyTariffOrderCount . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/company']),
                                'active' => Yii::$app->controller->module->id == 'company' && Yii::$app->controller->action->id == 'index',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $companyCountModer . '</small></span></a>',
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category_company']),
                                'active' => Yii::$app->controller->module->id == 'category_company' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasPermission(['Категории компаний'])
                            ],
                            [
                                'label' => 'Топ',
                                'url' => Url::to(['/top_company/top_company']),
                                'active' => Yii::$app->controller->module->id == 'top_company',
                                'visible' => UserFunction::hasPermission(['Топ компаний'])
                            ],
                            [
                                'label' => 'Развлечения',
                                'url' => Url::to(['/entertainment']),
                                'active' => Yii::$app->controller->module->id == 'entertainment' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasPermission(['Развлечения компаний'])
                            ],
                            [
                                'label' => 'Рекомендуем',
                                'url' => Url::to(['/company/company/we-recommend-companies']),
                                'active' => Yii::$app->controller->module->id === 'company' && Yii::$app->controller->action->id === 'we-recommend-companies',
                                'visible' => UserFunction::hasPermission(['Рекомендуем компаний'])
                            ],
                            [
                                'label' => 'Отзывы',
                                'url' => Url::to(['/company_feedback/company_feedback']),
                                'active' => Yii::$app->controller->module->id === 'company_feedback',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-blue">' . $countFeedback . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Отзывы компаний'])
                            ],
                            [
                                'label' => 'Просмотры',
                                'url' => Url::to(['/company_views/company-views']),
                                'active' => Yii::$app->controller->module->id === 'company_views' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Популярные акции',
                                'url' => Url::to(['/company/company/hot-stock']),
                                'active' => Yii::$app->controller->module->id === 'company' && Yii::$app->controller->action->id === 'hot-stock',
                                'visible' => UserFunction::hasPermission(['Популярные акции компаний'])
                            ],
                            [
                                'label' => 'Социальные сети',
                                'url' => Url::to(['/company/soc_available']),
                                'active' => Yii::$app->controller->module->id === 'soc_available' && Yii::$app->controller->action->id === 'soc_available',
                                'visible' => UserFunction::hasPermission(['Социальные сети компаний'])

                            ],
                            [
                                'label' => 'Мессенджеры',
                                'url' => Url::to(['/company/messenger']),
                                'active' => Yii::$app->controller->module->id === 'messenger' && Yii::$app->controller->action->id === 'messenger',
                            ],
                        ],

                        'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#">
                                    <i class="fa fa-building-o"></i> 
                                    <span>{label}</span> 
                                      <span class="pull-right-container">
                                          <small class="label pull-right bg-yellow">'. $CompanyTariffOrderCount .'</small>
                                          <span class="label bg-red pull-right">'. $companyCountModer .'</span>
                                          <small class="label pull-right bg-blue">' . $countFeedback . '</small>
                                      </span>  
                            </a>',
                    ],
                    [
                        'label' => 'Журналы',
                        'url' => Url::to(['/journal/journal']),
                        'active' => Yii::$app->controller->module->id == 'journal' && Yii::$app->controller->id == 'journal',
                        'template' => '<a href="{url}"><i class="fa fa-book"></i> <span>{label}</span><span class="pull-right-container"></a>',
                    ],
                    [
                        'label' => 'Товары',
                        'items' => [
                            [
                                'label' => 'Товары',
                                'url' => Url::to(['/products/products']),
                                'active' => Yii::$app->controller->module->id == 'products' && Yii::$app->controller->id == 'products',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countProducts . '</small></span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Категории товаров',
                                'url' => Url::to(['/products/category']),
                                'active' => Yii::$app->controller->module->id == 'products' && Yii::$app->controller->id == 'category',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Доп. поля',
                                'url' => Url::to(['/products/fields']),
                                'active' => Yii::$app->controller->module->id == 'products' && Yii::$app->controller->id == 'fields',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Значения по умолчанию',
                                'url' => Url::to(['/products/default-value']),
                                'active' => Yii::$app->controller->module->id == 'products' && Yii::$app->controller->id == 'default-value',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                        ],

                        //'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#">
                                    <i class="fa fa-product-hunt"></i> 
                                    <span class="label bg-red pull-right">'. $countProducts .'</span>
                                    <span>{label}</span> 
                                      
                            </a>',
                    ],
                    [
                        'label' => 'Заказы',
                        'items' => [
                            [
                                'label' => 'Ожидают обработки',
                                'url' => Url::to(['/orders/default/waiting']),
                                'active' => Yii::$app->controller->module->id == 'orders' && Yii::$app->controller->id == 'default' && Yii::$app->controller->action->id === 'waiting',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . "" . '</small></span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Приняты',
                                'url' => Url::to(['/orders/default/accepted']),
                                'active' => Yii::$app->controller->action->id === 'accepted' && Yii::$app->controller->id == 'default',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Готовы',
                                'url' => Url::to(['/orders/default/redy']),
                                'active' => Yii::$app->controller->action->id === 'redy' && Yii::$app->controller->id == 'default',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],

                        ],

                        //'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#">
                                    <i class="fa fa-shopping-cart"></i> 
                                    <span class="label bg-red pull-right">'. '' .'</span>
                                    <span>{label}</span> 
                                      
                            </a>',
                    ],
                    [
                        'label' => 'Услуги',
                        'items' => [
                            [
                                'label' => 'Услуги',
                                'url' => Url::to(['/service/service']),
                                'active' => Yii::$app->controller->module->id == 'service' && Yii::$app->controller->id == 'service',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countService . '</small></span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Категории услуг',
                                'url' => Url::to(['/service/category']),
                                'active' => Yii::$app->controller->module->id == 'service' && Yii::$app->controller->id == 'category',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Время работы',
                                'url' => Url::to(['/service/service-periods']),
                                'active' => Yii::$app->controller->module->id == 'service' && Yii::$app->controller->id == 'service-periods',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                            [
                                'label' => 'Бронирования',
                                'url' => Url::to(['/service/service-reservation']),
                                'active' => Yii::$app->controller->module->id == 'service' && Yii::$app->controller->id == 'service-reservation',
                                'template' => '<a href="{url}"><span>{label}</span></a>',
                                //'visible' => UserFunction::hasPermission(['Заявки компаний'])
                            ],
                        ],

                        //'visible' => UserFunction::hasPermission(['Компании']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#">
                                    <i class="fa fa-user"></i> 
                                    <span class="label bg-red pull-right">'. $countService .'</span>
                                    <span>{label}</span> 
                                      
                            </a>',
                    ],
                    [
                        'label' => 'Афиша',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/poster/poster/create']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'create',
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/poster']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'index',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label bg-red pull-right">' . $countPoster . '</small></span></a>',
                            ],
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/category_poster']),
                                'active' => Yii::$app->controller->module->id == 'category_poster' && Yii::$app->controller->action->id == 'index',
                                'visible' => UserFunction::hasPermission(['Афиша категории']),
                            ],
                            [
                                'label' => 'Главная Афиша',
                                'url' => Url::to(['/main-premiere']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'main-premiere',
                                'visible' => UserFunction::hasPermission(['Главная Афиша']),
                            ],
                            [
                                'label' => 'Баннер Афиша',
                                'url' => Url::to(['/poster/poster/main-poster']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'main-poster',
                                'visible' => UserFunction::hasPermission(['Баннер Афиша']),
                            ],
                            [
                                'label' => 'Может заинтересовать',
                                'url' => Url::to(['/poster/poster/interested-in']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'interested-in',
                                'visible' => UserFunction::hasPermission(['Может заинтересовать афиша']),
                            ],
                            [
                                'label' => 'Слайдер',
                                'url' => Url::to(['/poster/poster/top-slider']),
                                'active' => Yii::$app->controller->module->id == 'poster' && Yii::$app->controller->action->id == 'top-slider',
                                'visible' => UserFunction::hasPermission(['Верхнйи слайдер на странице афиш']),
                            ],
                        ],
                        'visible' => UserFunction::hasPermission(['Афиша']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '
                            <a href="#">
                                    <i class="fa fa-university"></i> 
                                    <span>{label}</span> 
                                      <span class="pull-right-container">
                                          <span class="label bg-red pull-right">'. $countPoster .'</span>
                                      </span>  
                            </a>',
                    ],
                    [
                        'label' => 'Консалтинг',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/consulting/consulting/create']),
                                'active' => Yii::$app->controller->module->id == 'consulting' && Yii::$app->controller->action->id == 'create',
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/consulting/consulting']),
                                'active' => Yii::$app->controller->module->id == 'consulting' && Yii::$app->controller->action->id == 'index',
                            ],

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
                            ],
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/faq/faq']),
                                'active' => Yii::$app->controller->module->id == 'faq' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Категории FAQ',
                                'url' => Url::to(['/category_faq/category_faq']),
                                'active' => Yii::$app->controller->module->id == 'category_faq' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),
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
                            ],
                            [
                                'label' => 'Все статьи',
                                'url' => Url::to(['/posts_consulting/posts_consulting']),
                                'active' => Yii::$app->controller->module->id == 'posts_consulting' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Категории статей',
                                'url' => Url::to(['/category_posts_consulting/category_posts_consulting']),
                                'active' => Yii::$app->controller->module->id == 'category_posts_consulting' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),
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
                            ],
                            [
                                'label' => 'Все статьи Дайджест',
                                'url' => Url::to(['/posts_digest/posts_digest']),
                                'active' => Yii::$app->controller->module->id == 'posts_digest' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Категории статей',
                                'url' => Url::to(['/category_posts_digest/category_posts_digest']),
                                'active' => Yii::$app->controller->module->id == 'category_posts_digest' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'create'),

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
                            ],
                            [
                                'label' => 'Все опросы',
                                'url' => Url::to(['/polls']),
                                'active' => Yii::$app->controller->module->id == 'polls' && Yii::$app->controller->action->id == 'index',
                            ],
                            [
                                'label' => 'Активный опрос',
                                'url' => Url::to(['/active_poll']),
                                'active' => Yii::$app->controller->module->id == 'active_poll' && Yii::$app->controller->action->id == 'index',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Страницы',
                        'items' => [
                            [
                                'label' => 'Добавить',
                                'url' => Url::to(['/pages/pages/create']),
                                'active' => Yii::$app->controller->module->id === 'pages' && Yii::$app->controller->action->id === 'create',
                            ],
                            [
                                'label' => 'Все страницы',
                                'url' => Url::to(['/pages/pages']),
                                'active' => Yii::$app->controller->module->id === 'pages',
                            ],
                            [
                                'label' => 'Группы',
                                'url' => Url::to(['/pages_group/pages_group']),
                                'active' => Yii::$app->controller->module->id === 'pages_group',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['Страницы']),
                        'template' => '<a href="#"><i class="fa fa-file-o"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'ВК',
                        'items' => [
                            [
                                'label' => 'Группы',
                                'url' => Url::to(['/vk/vk_groups']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_groups',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Авторы',
                                'url' => Url::to(['/vk/vk_authors']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_authors',
                                'visible' => UserFunction::hasPermission(['Авторы VK']),
                            ],
                            [
                                'label' => 'Комментарии',
                                'url' => Url::to(['/vk/vk_comments']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_comments',
                                'visible' => UserFunction::hasPermission(['Комментарии VK']),
                            ],
                            [
                                'label' => 'Поток',
                                'url' => Url::to(['/vk/vk_stream']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_stream',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countModerStream . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Поток VK']),
                            ],
                            [
                                'label' => 'На публикацию',
                                'url' => Url::to(['/vk/vk_publish']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_publish',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countPublishStream . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['На публикацию VK']),
                            ],
                            [
                                'label' => 'Корзина',
                                'url' => Url::to(['/vk/vk_basket']),
                                'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_basket',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countBasketStream . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Корзина VK']),
                            ],
                            [
                                'label' => 'Опубликованные',
                                'url' => Url::to(['/vk/vk_published']),
                                'active' => Yii::$app->controller->id === 'vk_published' && Yii::$app->controller->action->id === 'index',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countPublishedStream . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Опубликованные VK']),
                            ],
                            [
                                'label' => 'Отложенные',
                                'url' => Url::to(['/vk/vk_published/deffered']),
                                'active' => Yii::$app->controller->action->id === 'deffered' && Yii::$app->controller->id === 'vk_published',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countDefferedStream . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Отложенные VK']),
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['ВК']),
                        'template' => '<a href="#"><i class="fa fa-vk"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Twitter',
                        'items' => [
                            [
                                'label' => 'Страницы',
                                'url' => Url::to(['/tw/tw-pages']),
                                'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-pages',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Посты',
                                'url' => Url::to(['/tw/tw-posts', 'TwPostsSearch[status]' => 0]),
                                //'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch') === null,
	                            'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch')['status'] === '0',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            /*[
                                'label' => 'На модерации',
                                'url' => Url::to(['/tw/tw-posts', 'TwPostsSearch[status]' => 0]),
                                'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch')['status'] === '0',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],*/
                            [
                                'label' => 'Опубликованные',
                                'url' => Url::to(['/tw/tw-posts', 'TwPostsSearch[status]' => 1]),
                                'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch')['status'] === '1',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'На публикацию',
                                'url' => Url::to(['/tw/tw-posts', 'TwPostsSearch[status]' => 2]),
                                'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch')['status'] === '2',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Отложенные',
                                'url' => Url::to(['/tw/tw-posts', 'TwPostsSearch[status]' => 4]),
                                'active' => Yii::$app->controller->module->id === 'tw' && Yii::$app->controller->id === 'tw-posts' && Yii::$app->request->get('TwPostsSearch')['status'] === '4',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            //[
                            //    'label' => 'Авторы',
                            //    'url' => Url::to(['/vk/vk_authors']),
                            //    'active' => Yii::$app->controller->module->id === 'vk' && Yii::$app->controller->id === 'vk_authors',
                            //    'visible' => UserFunction::hasPermission(['Авторы VK']),
                            //],

                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['ВК']),
                        'template' => '<a href="#"><i class="fa fa-twitter"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Google+',
                        'items' => [
                            [
                                'label' => 'Пользователи',
                                'url' => Url::to(['/google/users']),
                                'active' => Yii::$app->controller->module->id === 'google' && Yii::$app->controller->id === 'users',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Посты',
                                'url' => Url::to(['/google/posts']),
                                'active' => Yii::$app->controller->module->id === 'google' && Yii::$app->controller->id === 'posts',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Опубликованные',
                                'url' => Url::to(['/google/published']),
                                'active' => Yii::$app->controller->module->id === 'google' && Yii::$app->controller->id === 'published' && Yii::$app->controller->action->id !== 'deffered',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Отложенные',
                                'url' => Url::to(['/google/published/deffered']),
                                'active' => Yii::$app->controller->action->id === 'deffered' && Yii::$app->controller->id === 'published',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countDefferedStreamGoogle . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Отложенные VK']),
                            ],


                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['ВК']),
                        'template' => '<a href="#"><i class="fa fa-google-plus"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Instagram',
                        'items' => [
                            [
                                'label' => 'Пользователи',
                                'url' => Url::to(['/instagram/account']),
                                'active' => Yii::$app->controller->module->id === 'instagram' && Yii::$app->controller->id === 'account',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Фото',
                                'url' => Url::to(['/instagram/photo']),
                                'active' => Yii::$app->controller->module->id === 'instagram' && Yii::$app->controller->id === 'photo' && Yii::$app->controller->action->id !== 'onpublish',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'На публикацию',
                                'url' => Url::to(['/instagram/photo/publish']),
                                'active' => Yii::$app->controller->action->id === 'publish' && Yii::$app->controller->id === 'photo',
                                'visible' => UserFunction::hasPermission(['Группы VK']),
                            ],
                            [
                                'label' => 'Опубликованные',
                                'url' => Url::to(['/instagram/photo/published']),
                                'active' => Yii::$app->controller->action->id === 'published' && Yii::$app->controller->id === 'photo',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . "" . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Отложенные VK']),
                            ],
                            [
                                'label' => 'Отложенные',
                                'url' => Url::to(['/instagram/photo/defered']),
                                'active' => Yii::$app->controller->action->id === 'defered' && Yii::$app->controller->id === 'photo',
                                'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . "" . '</small></span></a>',
                                'visible' => UserFunction::hasPermission(['Отложенные VK']),
                            ],


                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['ВК']),
                        'template' => '<a href="#"><i class="fa fa-instagram"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Курсы валют',
                        'visible' => UserFunction::hasPermission(['Курсы валют']),
                        'items' => [
                            [
                                'label' => 'Типы',
                                'url' => Url::to(['/exchange_rates/exchange_rates_type']),
                                'active' => Yii::$app->controller->id == 'exchange_rates_type',
                            ],
                            [
                                'label' => 'Валюты',
                                'url' => Url::to(['/exchange_rates/exchange_rates']),
                                'active' => Yii::$app->controller->id == 'exchange_rates',
                            ],
                            [
                                'label' => "Валюты ЦБРФ<br>Криптовалюты<br>Металлы",
                                'url' => Url::to(['/currency/currency']),
                                'active' => Yii::$app->controller->id == 'currency',
                            ],
                            [
                                'label' => 'Курсы',
                                'url' => Url::to(['/currency/currency-rate']),
                                'active' => Yii::$app->controller->id == 'currency-rate' ,
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
                        'visible' => UserFunction::hasPermission(['Подписчики']),
                    ],
                    [
                        'label' => 'SЕО',
                        'visible' => UserFunction::hasPermission(['СЕО']),
                        'items' => [
                            [
                                'label' => 'Все',
                                'url' => Url::to(['/seo']),
                                'active' => Yii::$app->controller->module->id == 'seo',
                            ],
                            [
                                'label' => 'Валюты',
                                'url' => Url::to(['/seo/default/currency']),
                                'active' => Yii::$app->controller->action->id === 'currency',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-usd"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Переменные',
                        'url' => Url::to(['/key_value']),
                        'template' => '<a href="{url}"><i class="fa fa-ellipsis-h"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'key_value',
                        'visible' => UserFunction::hasPermission(['Переменные']),
                    ],
                    /*[
                        'label' => 'Языки',
                        'url' => Url::to(['/lang']),
                        'template' => '<a href="{url}"><i class="fa fa-language"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'lang',
                        'visible' => UserFunction::hasPermission(['Языки']),
                    ],*/
                    [
                        'label' => 'Ситуации',
                        'visible' => UserFunction::hasPermission(['Ситуации']),
                        'items' => [
                            [
                                'label' => 'Статусы',
                                'url' => Url::to(['/situation/situation_status']),
                                'active' => Yii::$app->controller->module->id == 'situation',
                            ],
                            [
                                'label' => 'Блок посты',
                                'url' => Url::to(['/situation/situation']),
                                'active' => Yii::$app->controller->module->id == 'situation',
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
                        'visible' => UserFunction::hasPermission(['О чем говорят в городе']),
                    ],
                    [
                        'label' => 'Обращения',
                        'url' => Url::to(['/contacting/contacting']),
                        'visible' => UserFunction::hasPermission(['Обращения']),
                        'template' => '<a href="{url}"><span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countContacting . '</small></span></a>',
                    ],
                    [
                        'label' => 'РОСС-ОПТ',
                        'items' => [
                            [
                                'label' => 'Настройки',
                                'url' => Url::to(['/rossopt/default']),
                                'active' => Yii::$app->controller->module->id == 'rossopt',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'visible' => UserFunction::hasPermission(['РОСС-ОПТ']),
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],

                    [
                        'label' => 'Тарифы и услуги',
                        'visible' => UserFunction::hasPermission(['Тарифы и услуги']),
                        'items' => [
                            [
                                'label' => 'Услуги',
                                'url' => Url::to(['/services/services/index']),
                                'active' => Yii::$app->controller->module->id == 'services',
                            ],
                            [
                                'label' => 'Тарифы',
                                'url' => Url::to(['/tariff/tariff/index']),
                                'active' => Yii::$app->controller->module->id == 'tariff',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Ошибки',
                        'url' => Url::to(['/site_error/error/index']),
                        'visible' => UserFunction::hasPermission(['Ошибки']),
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="{url}"><i class="fa fa-comments"></i> <span>{label}</span><span class="pull-right-container"><small class="label pull-right bg-red">' . $countError . '</small></span></a>',
                    ],
                    [
                        'label' => 'ГЕО',
                        'visible' => UserFunction::hasPermission(['ГЕО']),
                        'items' => [
                            [
                                'label' => 'Области',
                                'url' => Url::to(['/region/region/index']),
                                'active' => Yii::$app->controller->module->id == 'region',
                            ],
                            [
                                'label' => 'Города',
                                'url' => Url::to(['/city/city/index']),
                                'active' => Yii::$app->controller->module->id == 'city',
                            ],
                            [
                                'label' => 'IP адреса',
                                'url' => Url::to(['/geobase_ip/geobase-ip/index']),
                                'active' => Yii::$app->controller->module->id == 'geobase_ip',
                            ],
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
                    [
                        'label' => 'Теги',
                        'url' => Url::to(['/tags/tags']),
                        'template' => '<a href="{url}"><i class="fa fa-tags"></i> <span>{label}</span></a>',
                        'active' => Yii::$app->controller->module->id == 'tags' || Yii::$app->controller->module->id == 'tags',
                        'visible' => UserFunction::hasPermission(['Теги']),
                    ],
                    [
                        'label' => 'Sima Land API',
                        'items' => [
                            [
                                'label' => 'Категории',
                                'url' => Url::to(['/sima_land/categories/index']),
                                'active' => Yii::$app->controller->module->id == 'categories',
                            ],
                            [
                                'label' => 'Товары',
                                'url' => Url::to(['/sima_land/goods/index']),
                                'active' => Yii::$app->controller->module->id == 'goods',
                            ]
                        ],
                        'options' => [
                            'class' => 'treeview',
                        ],
                        'template' => '<a href="#"><i class="fa fa-bar-chart"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                    ],
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
