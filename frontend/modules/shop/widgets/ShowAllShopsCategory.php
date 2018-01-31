<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.01.18
 * Time: 15:11
 */

namespace frontend\modules\shop\widgets;

use common\classes\Debug;
use common\models\db\CategoryShop;
use yii\base\Widget;

class ShowAllShopsCategory extends Widget
{
    public function run()
    {
        $category = CategoryShop::find()->all();

        $categoryTree = $this->categoryTree($category);
        Debug::prn($category);
        return $this->render('all-category');
    }

    protected function categoryTree($category)
    {

        return $category;
    }
}