<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 28.11.17
 * Time: 12:43
 */

namespace frontend\modules\company\widgets;

use common\classes\CompanyFunction;
use common\classes\Debug;
use common\models\db\CategoryCompany;
use yii\base\Widget;

class ShowMenuCategory extends Widget
{
    public function run()
    {
        $category = CategoryCompany::find()->asArray()->all();
        $categoryArr = CompanyFunction::getCategoryTopMenu($category);
       // Debug::prn($categoryArr);

        return $this->render('menu_category');
    }
}