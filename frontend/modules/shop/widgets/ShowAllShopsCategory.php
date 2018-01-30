<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.01.18
 * Time: 15:11
 */

namespace frontend\modules\shop\widgets;

use yii\base\Widget;

class ShowAllShopsCategory extends Widget
{
    public function run()
    {
        return $this->render('all-category');
    }
}