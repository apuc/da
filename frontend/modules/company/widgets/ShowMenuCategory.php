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
use yii\helpers\ArrayHelper;

class ShowMenuCategory extends Widget
{
    public function run()
    {
        $category = CategoryCompany::find()->asArray()->all();
        $categoryTopArr = CompanyFunction::getCategoryTopMenu($category);

        $categoryAllArr = CompanyFunction::getCategoryAllMenu($category, $categoryTopArr['catId']);


        $categoryMob = CompanyFunction::getCategoryMobMenu($category);
        /*Debug::prn($categoryMob);
        die();*/
        return $this->render('menu_category',
            [
                'categoryTopArr' => $categoryTopArr,
                'categoryAllArr' => $categoryAllArr,
                'categoryMob' => $categoryMob,
            ]);
    }
}