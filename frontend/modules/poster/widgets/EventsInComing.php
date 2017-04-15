<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 13:04
 */

namespace frontend\modules\poster\widgets;

use yii\base\Widget;

class EventsInComing extends Widget
{

    public function run()
    {
        return $this->render('events_in_coming');
    }

}