<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 20.05.2017
 * Time: 12:35
 */

namespace frontend\widgets;

use yii\base\Widget;

class FooterSocial extends Widget
{

    public function run()
    {
        return $this->render('footer_social');
    }

}