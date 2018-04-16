<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 11.04.18
 * Time: 10:10
 */

namespace frontend\modules\shop\widgets;

use yii\base\Widget;

class ShowFilterTopProducts extends Widget
{
    public function run()
    {
        $get = \Yii::$app->request->get();

        return $this->render('top-filter', ['get' => $get]);
    }
}