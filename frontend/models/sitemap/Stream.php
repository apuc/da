<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 21.12.17
 * Time: 14:28
 */

namespace frontend\models\sitemap;

use common\models\db\VkStream;
use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;

class Stream extends VkStream
{
    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select([]);
                    $model->where(['status' => 1]);
                    $model->orderBy('dt_publish DESC');
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::to(['/stream/default/view','slug'=>$model->slug]),
                        'title' => $model->title,
                        'lastmod' => $model->dt_publish,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ],
        ];
    }
}