<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.05.2017
 * Time: 22:11
 */

namespace frontend\widgets;

use yii\base\Widget;

class Subscribe extends Widget
{

    public function run()
    {
        return $this->render('subscribe');
    }

}