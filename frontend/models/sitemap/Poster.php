<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 14.07.2017
 * Time: 16:16
 */

namespace frontend\models\sitemap;

use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;

class Poster extends \common\models\db\Poster
{
    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select([]);
                    $model->andWhere(['>=', 'dt_event_end', time()]);
                    $model->orderBy('dt_update DESC');
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::to(['/poster/default/view','slug'=>$model->slug]),
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