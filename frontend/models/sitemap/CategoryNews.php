<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 14.07.2017
 * Time: 13:56
 */

namespace frontend\models\sitemap;

use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;

class CategoryNews extends \common\models\db\CategoryNews
{
    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select([]);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::to(['/news/news/category','slug'=>$model->slug]),
                        'title' => $model->title,
                        'lastmod' => $model->dt_update,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ],
        ];
    }
}