<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 08.02.18
 * Time: 11:03
 */

namespace frontend\modules\shop\models;

class Products extends \common\models\db\Products
{
    /**
     * Получить список всех категорий начиная с последней(Только заголовки категорий)
     * @param $id
     * @param $arr
     * @return array
     */

    public function getListCategory($id,$arr){
        $category = CategoryShop::find()->where(['id' => $id])->one();
        $arr[] = $category->name;

        if($category->parent_id != 0){
            $arr = self::getListCategory($category->parent_id, $arr);
        }
        else{
            $arr[] = $category->icon;
        }
        //$arrEnd = array_reverse($arr);
        return $arr;
    }
}