<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 28.06.2017
 * Time: 11:56
 */

namespace frontend\modules\personal_area\widgets;

use yii\base\Widget;

class ShowPersonalAreaTollbar extends Widget
{
    public function run()
    {
        return $this->render('tollbar');
    }
}