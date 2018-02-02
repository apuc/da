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

    public function getCategoryUrlEnd($category)
    {
        $category = explode('/', $category);
        $slug = array_pop($category);
        return $slug;
    }

    public function getCategoryInfoBySlug($category)
    {
        return CategoryShop::find()->where(['slug' => $this->getCategoryUrlEnd($category)])->one();
    }
}