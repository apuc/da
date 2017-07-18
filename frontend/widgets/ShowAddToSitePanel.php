<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 17.07.2017
 * Time: 10:56
 */

namespace frontend\widgets;

use yii\base\Widget;

class ShowAddToSitePanel extends Widget
{
    public function run()
    {
        return $this->render('add-to-site-panel');
    }
}