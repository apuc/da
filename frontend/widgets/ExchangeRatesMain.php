<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 11:03
 */

namespace frontend\widgets;

use common\models\db\ExchangeRatesType;
use yii\base\Widget;

class ExchangeRatesMain extends Widget
{

    public function run()
    {
        $rates = ExchangeRatesType::find()->with('exchange_rates')->all();
        return $this->render('ex', ['rates'=>$rates]);
    }

}