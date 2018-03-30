<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 04.07.2017
 * Time: 13:31
 */

namespace frontend\modules\personal_area\models;

use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;

class UserCommentsSearch
{
    public function search($params)
    {
        $queryNews = (new Query())
            ->select([
                'id',
                'news_id as post_id',
                new Expression('"news" as post_type'),
                'user_id',
                'content',
                'dt_add',
                'parent_id',
                'moder_checked',
                'published',
                'verified',
            ])
            ->from('news_comments')
            ->where(['user_id' => $params['user_id']]);

        $queryPages = (new Query())
            ->select([
                'id',
                'pages_id as post_id',
                new Expression('"page" as post_type'),
                'user_id',
                'content',
                'dt_add',
                'parent_id',
                'moder_checked',
                'published',
                'verified',
            ])
            ->from('pages_comments')
            ->where(['user_id' => $params['user_id']]);

        $queryVkStream = (new Query())
            ->select([
                'id',
                'vk_stream_id as post_id',
                new Expression('"vk_post" as post_type'),
                'user_id',
                'content',
                'dt_add',
                'parent_id',
                'moder_checked',
                'published',
                'verified',
            ])
            ->from('vk_stream_comments')
            ->where(['user_id' => $params['user_id']]);

        $queryStock = (new Query())
            ->select([
                'id',
                'stock_id as post_id',
                new Expression('"stock" as post_type'),
                'user_id',
                'content',
                'dt_add',
                'parent_id',
                'moder_checked',
                'published',
                'verified',
            ])
            ->from('stock_comments')
            ->where(['user_id' => $params['user_id']]);

        $unionQuery = $queryNews->union($queryPages)->union($queryVkStream)->union($queryStock);
        $query = (new Query())
            ->from(['unionQuery' => $unionQuery])
            ->orderBy(['dt_add' => SORT_DESC]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
            ],
        ]);

        return $dataProvider;
    }
}