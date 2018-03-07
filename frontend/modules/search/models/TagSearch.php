<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.10.2017
 * Time: 13:20
 */

namespace frontend\modules\search\models;

use backend\modules\tags\models\TagsRelation;
use common\classes\Debug;
use common\models\db\Tags;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class TagSearch
{
    public $tagId;

    public function search()
    {
        $limit = 15;
        $countArr = count($this->tagId);
        if ($countArr >= 1 && !is_string($this->tagId)) {
            $idStr = implode(',', $this->tagId);
        } else {
            $idStr = $this->tagId;
        }
        $queryNews = (new Query())
            ->select([
                'news.id',
                'tags_relation.type',
                'news.title AS title',
                'news.slug',
                'news.photo',
                'news.dt_update',
                'news.content AS content'
            ])
            ->from('news')
            ->innerJoin('tags_relation',
                "`tags_relation`.`type` = 'news' 
                     AND `news`.`id` = `tags_relation`.`post_id`
                     AND `tags_relation`.`tag_id` IN({$idStr})")
            ->where(['news.status' => 0])
            ->limit($limit);

        $queryCompany = (new Query())
            ->select([
                'company.id',
                'tags_relation.type',
                'company.name  AS title',
                'company.slug',
                'company.photo',
                'company.dt_update',
                'company.descr AS content'
            ])
            ->from('company')
            ->innerJoin('tags_relation',
                "`tags_relation`.`type` = 'company' 
                     AND `company`.`id` = `tags_relation`.`post_id` 
                     AND `tags_relation`.`tag_id` IN({$idStr})")
            ->where(['company.status' => 0])
            ->limit($limit);

        $queryPoster = (new Query())
            ->select([
                'poster.id',
                'tags_relation.type',
                'poster.title AS title',
                'poster.slug',
                'poster.photo',
                'poster.dt_update',
                'poster.descr AS content'
            ])
            ->from('poster')
            ->innerJoin('tags_relation',
                "`tags_relation`.`type` = 'poster' 
                     AND `poster`.`id` = `tags_relation`.`post_id` 
                     AND `tags_relation`.`tag_id` IN({$idStr})")
            ->where(['poster.status' => 0])
            ->limit($limit);

        $unionQuery = $queryNews->union($queryCompany)->union($queryPoster);
        $query = (new Query())
            ->from(['unionQuery' => $unionQuery])
            ->orderBy(['dt_update' => SORT_DESC]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit,
                'pageSizeParam' => false,
            ],
        ]);

        return $dataProvider;
    }

    public function randTags()
    {
        $randTags = Tags::find()->orderBy('RAND()')->limit(5)->asArray()->all();

        $tags = '';
        foreach ($randTags as $key => $tag) {
            $tags .= $tag['tag'];
            if ($key < 4) {
                $tags .= '|';
            }
        }
        return $tags;
    }
}