<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 20.06.2017
 * Time: 11:00
 */

namespace frontend\modules\mainpage\widgets;

use yii\base\Widget;

class CommunalRates extends Widget
{
    public function run()
    {
        return $this->render('communal-rates');
    }
}