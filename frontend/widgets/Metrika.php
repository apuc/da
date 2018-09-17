<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 15:32
 */

namespace frontend\widgets;


use yii\base\Widget;

class Metrika extends Widget
{

    public function run()
    {
        return $this->render('metriks');
    }

}