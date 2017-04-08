<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.04.2017
 * Time: 23:08
 */

namespace frontend\modules\poster\widgets;

use yii\base\Widget;

class InterestedIn extends Widget
{

    public function run()
    {
        return $this->render('interested_in');
    }

}