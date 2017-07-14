<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 14.07.2017
 * Time: 16:07
 */

namespace frontend\models\sitemap;

use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;

class Company extends \common\models\db\Company
{
    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select([]);
                    $model->andWhere(['status' => [0]]);
                    $model->orderBy('dt_update DESC');
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::to(['/company/company/view','slug'=>$model->slug]),
                        'title' => $model->name,
                        'lastmod' => $model->dt_update,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ],
        ];
    }
}