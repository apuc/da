<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 07.08.2017
 * Time: 11:28
 */

namespace frontend\modules\board\widgets;

use yii\base\Widget;

class ShowFilterLeft extends Widget
{
    public function run()
    {
        return $this->render('ads-filter-left');
    }
}