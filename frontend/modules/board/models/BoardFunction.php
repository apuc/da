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

    //Получить label дополнительного поля
    public static function getLabelAdditionalField($name){
        //$label=  AdsFields::find()->where(['name' => $name])->one()->label;
        $label=  file_get_contents(Yii::$app->params['site-api'] . '/ads/get-label-additional-field?name=' . $name);
        //Debug::prn($label);
        return str_replace('"', '', $label);
    }
}