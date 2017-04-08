<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 10:55
 */

namespace frontend\modules\poster\models;


use common\classes\Debug;
use common\models\db\CategoryPosterRelations;

class Poster extends \common\models\db\Poster
{

    public static function getCategoryName($poster_id){
        $cats = CategoryPosterRelations::find()
            ->leftJoin('category_poster', '`category_poster_relations`.`cat_id` = `category_poster`.`id`')
            ->where(['poster_id'=>$poster_id])
            ->with('category_poster')
            ->all();
        $str = '';
        foreach($cats as $cat){
            $str .= $cat['category_poster']->title . ",";
        }
        return substr($str, 0, -1);
    }

}