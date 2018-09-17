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
    public $category;

    public function run()
    {
        return $this->render('all-category', ['category' => $this->category]);
    }
}