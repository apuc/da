<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;


use common\models\db\KeyValue;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class ExchangeRates extends Widget
{

    public function run()
    {
        $key_value = KeyValue::find()->all();
        return $this->render('exchange_rates',[
            'key_value' => ArrayHelper::map($key_value, 'key', 'value')
        ]);
    }

}