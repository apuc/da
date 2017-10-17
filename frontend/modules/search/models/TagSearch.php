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

class TagSearch
{
    public $tagId;

    public function search()
    {
        $query = TagsRelation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
                'pageSizeParam' => false,
            ],
        ]);

        $query->leftJoin('news', 'tags_relation.type = \'news\' AND `news`.`id`=`tags_relation`.`post_id`');
        $query->leftJoin('company', 'tags_relation.type = \'company\' AND `company`.`id`=`tags_relation`.`post_id`');

        $query->with('news', 'company');

        $query->where(['tag_id' => $this->tagId]);

        $query->orderBy('`news`.`dt_update` DESC');
        $query->addOrderBy('`company`.`dt_update` DESC');


        //Debug::prn($query->createCommand()->rawSql);
        return $dataProvider;
    }

    public function randTags()
    {
        $randTags = Tags::find()->orderBy('RAND()')->limit(5)->asArray()->all();

        $tags = '';
        foreach ($randTags as $key => $tag) {
            $tags .= $tag['tag'] ;
            if($key < 4) {
                $tags .= '|';
            }
        }
        return $tags;
    }
}