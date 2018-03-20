<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 20.03.18
 * Time: 9:18
 */

namespace common\classes;

use common\models\db\CategoryShop;
use yii\helpers\ArrayHelper;

class Shop
{
    public static function getChildrenCategory($id)
    {
        $category = CategoryShop::find()->where(['parent_id' => $id])->all();
        if (!empty($category)) {
            //$arrayResult = [];
            $arrayResult = ArrayHelper::getColumn($category, 'id');
            foreach ($category as $item) {
                $cat = CategoryShop::find()->where(['parent_id' => $item->id])->all();
                $arrayResult = array_merge($arrayResult, ArrayHelper::getColumn($cat, 'id'));
            }
        } else {
            $arrayResult[] = $id;
        }

        return $arrayResult;
    }

    /**
     * Получить список всех категорий начиная с последней(Вся информация)
     * @param $id
     * @param $arr
     * @return array
     */
    public static function getListCategoryAllInfo($id,$arr){
        $category = CategoryShop::find()->where(['id' => $id])->one();
        $arr[] = $category;

        if($category->parent_id != 0){
            $arr = self::getListCategoryAllInfo($category->parent_id, $arr);
        }

        //$arrEnd = array_reverse($arr);
        return $arr;
    }
}