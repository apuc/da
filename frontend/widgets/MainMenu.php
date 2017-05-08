<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.09.2016
 * Time: 14:28
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\classes\UserFunction;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\widgets\Menu;

class MainMenu extends Widget
{

    public function run()
    {
        echo Menu::widget([
            'items' => [
                [
                    'label' => 'INFO PRO',
                    'url' => Url::to(['/']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'mainpage',
                ],
                [
                    'label' => 'Новости',
                    'url' => Url::to(['/all-new']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'news',
                ],
                [
                    'label' => 'Предприятия',
                    'url' => Url::to(['/all-company']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'company',
                ],
                [
                    'label' => 'Объявления',
                    'url' => Url::to(['/site/design']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'mainpage1',
                ],
                [
                    'label' => 'Афиша',
                    'url' => Url::to(['/all-poster']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'poster',
                ],
                [
                    'label' => 'Консультации',
                    'url' => Url::to(['/consulting']),
                    'template' => '<a href="{url}">{label}</a>',
                    'active' => Yii::$app->controller->module->id == 'mainpage1',
                ],

            ],
            'activateItems' => true,
            //'activateParents' => true,
            'activeCssClass'=>'active',
            'encodeLabels' => false,
            /*'dropDownCaret' => false,*/
            /*'submenuTemplate' => "\n<ul class='header__menu_mnu'>\n{items}\n</ul>\n",*/
            'options' => [
                'class' => 'header-menu',
            ]
        ]);
    }

}