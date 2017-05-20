<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 05.10.2016
 * Time: 16:38
 */

namespace frontend\widgets;

use common\models\db\KeyValue;
use yii\base\Widget;

class WeatherHeader extends Widget
{

    public function run()
    {

        return $this->render('weather-header', [
                'weather' => json_decode(KeyValue::findOne(['key' => 'weather'])->value),
            ]);
    }

}