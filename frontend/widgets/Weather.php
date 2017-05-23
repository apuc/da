<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 23.05.2017
 * Time: 13:05
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\WordFunctions;
use common\models\db\KeyValue;
use yii\base\Widget;

class Weather extends Widget
{
    public function run()
    {
        $weather = json_decode(KeyValue::findOne(['key' => 'weather'])->value, true);

        return $this->render('weather', ['weather' => $weather]);

    }
}