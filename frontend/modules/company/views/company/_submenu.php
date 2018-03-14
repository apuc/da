<?php
/**
 * @var $model \common\models\db\Company
 * @var string $slug
 * @var string $page
 */

use common\classes\CompanyFunction;
use frontend\modules\company\models\Company;
use yii\helpers\Url;

$role = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
if (isset($role['admin'])) {
    $role = 'admin';
} else {
    $role = 'user';
}
echo \yii\widgets\Menu::widget(
    [
        'items' => [
            [
                'label' => Company::$submenuLabels['about'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug]),
                'active' => $page == 'about',
            ],
            [
                'label' => Company::$submenuLabels['reviews'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'reviews']),
                'template' => '<a href="{url}">{label}<span class="tabs-counters">' . CompanyFunction::getCountReviews($model->id) . '</span></a>',
                'active' => $page == 'reviews',
            ],
            [
                'label' => Company::$submenuLabels['stocks'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'stocks']),
                'template' => '<a href="{url}">{label}<span class="tabs-counters">' . CompanyFunction::getCountStock($model->id) . '</span></a>',
                'active' => $page == 'stocks',
            ],
            [
                'label' => Company::$submenuLabels['products'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'products']),
                'template' => '<a href="{url}">{label}<span class="tabs-counters">' . CompanyFunction::getCountProduct($model->id) . '</span></a>',
                'active' => $page == 'products',
                //'visible' => $role == 'admin',
            ],
            [
                'label' => Company::$submenuLabels['news'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'news']),
                'active' => $page == 'news',
            ],
            [
                'label' => Company::$submenuLabels['statistics'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'statistics']),
                'active' => $page == 'statistics',
            ],
            [
                'label' => Company::$submenuLabels['map'],
                'url' => Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'map']),
                'active' => $page == 'map',
            ],
        ],
        'activateItems' => true,
        'activateParents' => true,
        'activeCssClass' => 'active',
        'encodeLabels' => false,
        /*'dropDownCaret' => false,*/
        /*'submenuTemplate' => "\n<ul class=\"business__tab-links\">\n{items}\n</ul>\n",*/
        'options' => [
            'class' => 'business__tab-links',
        ],
    ]
);