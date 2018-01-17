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
use yii\helpers\ArrayHelper;

class TagSearch
{
    public $tagId;

    public function search()
    {
        /*$query = TagsRelation::find()->select(
            '`news`.`title` = cn,
            `company`.`name` as cn,
             COUNT(*) as c');


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

        $query->where( ['`tags_relation`.`tag_id`' => $this->tagId] );
        //Debug::prn($this->tagId);
        //$query->where(['AND', 'tag_id', [2, 3, 4]]);
        $query->groupBy('type, post_id');

        $query->orderBy('`news`.`dt_update` DESC');
        $query->addOrderBy('`company`.`dt_update` DESC');
        $query->having('c=2');

        Debug::prn($query->createCommand()->rawSql);*/
        $countArr = count($this->tagId);
        if($countArr >= 1 && !is_string ($this->tagId)){
            $idStr = implode(',', $this->tagId);
        }else{
            $idStr = $this->tagId;
        }


        $sql = "SELECT 
            `tags_relation`.`type` as type,
            `news`.`title` as nn,
            `news`.`slug` as nslug,
            `news`.`photo` as nphoto,
            `news`.`dt_update` as ndt,
            `news`.`content` as ncontent,
            `company`.`name` as cn,
            `company`.`slug` as cslug,
            `company`.`photo` as cphoto,
            `company`.`dt_update` as cdt,
            `company`.`descr` as ccontent,
            
            `poster`.`title` as pn,
            `poster`.`slug` as pslug,
            `poster`.`photo` as pphoto,
            `poster`.`dt_update` as pdt,
            `poster`.`descr` as pcontent,
            
            COUNT(*) as c 
            FROM `tags_relation` 
            LEFT JOIN `news` ON tags_relation.type = 'news' AND `news`.`id`=`tags_relation`.`post_id` 
            LEFT JOIN `company` ON tags_relation.type = 'company' AND `company`.`id`=`tags_relation`.`post_id`
            LEFT JOIN `poster` ON tags_relation.type = 'poster' AND `poster`.`id`=`tags_relation`.`post_id`
            WHERE `tag_id` IN ($idStr) AND (`news`.`status`=0 OR `company`.`status`=0 OR `poster`.`status`=0)

            GROUP BY type, post_id HAVING c = $countArr
            ORDER BY `news`.`dt_update`, `company`.`dt_update`, `poster`.`dt_update` DESC";


       /* $query  =  TagsRelation::findBySql($sql);*/

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'pagination' => [
                'pageSize' => 15,
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
            $tags .= $tag['tag'] ;
            if($key < 4) {
                $tags .= '|';
            }
        }
        return $tags;
    }
}