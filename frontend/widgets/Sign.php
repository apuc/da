<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.10.2016
 * Time: 10:59
 */

namespace frontend\widgets;


use yii\base\Widget;

class Sign extends Widget
{

    public function run()
    {
        return $this->render('sign');
    }

}