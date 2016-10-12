<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 05.10.2016
 * Time: 14:57
 */

namespace frontend\widgets;


use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\widgets\Menu;

class MainSubMenu extends Widget
{

    public function run()
    {
        echo Menu::widget([
            'items' => [
                [
                    'label' => 'Конкурсы',
                    'url' => Url::to(['/']),
                    'template' => '<a href="{url}">{label}</a>',
                ],
                [
                    'label' => 'Фото видео отчет',
                    'url' => Url::to(['/']),
                    'template' => '<a href="{url}">{label}</a>',
                ],
                [
                    'label' => 'Финансы',
                    'url' => Url::to(['/all-company']),
                    'template' => '<a href="{url}">{label}</a>',
                ],
                [
                    'label' => 'Инвестиции',
                    'url' => Url::to(['/']),
                    'template' => '<a href="{url}">{label}</a>',
                ],
                [
                    'label' => 'Маршруты',
                    'url' => Url::to(['/']),
                    'template' => '<a href="{url}">{label}</a>',
                ],

            ],
            'activateItems' => true,
            //'activateParents' => true,
            'activeCssClass'=>'active',
            'encodeLabels' => false,
            'options' => [
                'class' => 'header-menu-bot-mnu',
            ]
        ]);
    }

}