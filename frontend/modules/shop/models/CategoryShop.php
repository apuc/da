<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 31.01.2018
 * Time: 22:14
 */

namespace frontend\modules\shop\models;

class CategoryShop extends \common\models\db\CategoryShop
{
   /* public function getTreeCategory($category, $parent_id, $array)
    {
        $result = [];
        if(is_array($category) and isset($category[$parent_id])){
            //$result[] =
        }

    }*/


   /* public function outTree($parent_id, $level, $arr = []) {
        $category_arr = self::getArrayTreeCategory(CategoryShop::find()->all()); //Делаем переменную $category_arr видимой в функции
        if (isset($category_arr[$parent_id])) { //Если категория с таким parent_id существует
            foreach ($category_arr[$parent_id] as $value) { //Обходим
                /**
                 * Выводим категорию
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)

                //echo "<div style='margin-left:" . ($level * 25) . "px;'>" . $value["name"] . "</div>";
                $arr[$level][] = $value;
                $level = $level + 1; //Увеличиваем уровень вложености
                //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level
                self::outTree($value["id"], $level, $arr);
                $level = $level - 1; //Уменьшаем уровень вложености
            }
        }
        return $arr;
    }*/

    public function getArrayTreeCategory($category)
    {
        $cats = array();

        foreach ($category as $item) {
            if(empty($item['parent_id'])){
                $item['parent_id'] = 0;
            }
            $cats[$item['parent_id']][$item['id']] =  $item;
            //$cats[$item['parent_id']][] =  $item;
        }
        return $cats;
    }
}