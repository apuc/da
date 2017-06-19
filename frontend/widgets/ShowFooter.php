<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 19.06.2017
 * Time: 11:34
 */

namespace frontend\widgets;

use yii\base\Widget;

class ShowFooter extends Widget
{
    public function run()
    {
        return $this->render('footer');
    }
}