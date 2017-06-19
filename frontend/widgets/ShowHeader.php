<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:57
 */

namespace frontend\widgets;

use yii\base\Widget;

class ShoWHeader extends Widget
{
    public function run()
    {
        return $this->render('header');
    }
}