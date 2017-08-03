<?php

namespace frontend\modules\board\models;

use common\classes\Debug;
use Yii;

class BoardFunction
{
    /**
     * Получить название категории по id
     */
    public static function getCategoryById($id, $arr)
    {
        //$cat = file_get_contents(Yii::$app->params['site-api'] . '/category/view?id=' . $id);


        $category = file_get_contents(Yii::$app->params['site-api'] . '/category/view?id=' . $id);

        $cat = json_decode($category);
        $arr[] = $cat;
        if($cat->parent_id != 0){
            $arr = self::getCategoryById($cat->parent_id, $arr);
        }

        //$arrEnd = array_reverse($arr);
        //Debug::prn($arr);
        return $arr;

    }
}