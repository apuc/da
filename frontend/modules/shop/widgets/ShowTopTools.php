<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.01.18
 * Time: 14:28
 */

namespace frontend\modules\shop\widgets;

use yii\base\Widget;

class ShowTopTools extends Widget
{
    public function run()
    {
        return $this->render('top-tools');
    }
}