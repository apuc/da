<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 31.01.2018
 * Time: 22:14
 */

namespace frontend\modules\shop\models;

use common\classes\Debug;

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
        //Debug::dd($category);
        $category = explode('/', $category);
        $slug = array_pop($category);
        if(is_int((int)$slug)){
            //Debug::dd(1231);
            $slug = array_pop($category);
        }
        //Debug::dd($slug);
        return $slug;
    }

    public function getCategoryInfoBySlug($category)
    {
        return CategoryShop::find()->where(['slug' => $this->getCategoryUrlEnd($category)])->one();
    }

    public function getEndCategory($category)
    {
        //Debug::dd($this->getCategoryUrlEnd($category));
        $cat = $this->getCategoryInfoBySlug($category);

        $catCount = CategoryShop::find()->where(['parent_id' => $cat->id])->count();

        if($catCount > 0){
            return true;
        }

        return false;
    }
}