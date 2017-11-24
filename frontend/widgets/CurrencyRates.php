<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 24.11.2017
 * Time: 9:49
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use common\models\db\KeyValue;
use yii\base\Widget;
use yii\db\Expression;

class CurrencyRates extends Widget
{
    public $currencyType = Currency::TYPE_CURRENCY;

    public function run()
    {
        //выборка последней даты по типу Валюты(ценности)
        $date = CurrencyRate::find()
            ->joinWith(['currencyFrom cf'])
            ->where(['cf.type' => $this->currencyType])
            ->orderBy('date DESC')
            ->one();
        if (empty($date)) $date = new Expression('CURDATE()');
        $rates_body = $rates_title = [];
        $rates = CurrencyRate::find()
            ->joinWith(['currencyFrom cf', 'currencyTo ct'])
            ->where([
                'cf.type' => $this->currencyType,
                'cf.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
                'ct.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
            ])
//            ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE_FOR_WIDGET])
            ->andWhere(['date' => $date])
            ->all();

        switch ($this->currencyType) {
            case Currency::TYPE_COIN:
                $title = KeyValue::findOne(['key' => 'currency_coin_title_page'])->value;
                foreach ($rates as $rate) {
                    if (!isset($rates_body[$rate->currency_from_id])) $rates_body[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->coin->full_name,
                        'USD' => null,
                        'EUR' => null,
                        'RUB' => null
                    ];
                    $rates_body[$rate->currency_from_id][$rate->currencyTo->char_code] = $rate->rate;
                }
                $rates_title = [
                    'name' => 'Криптовалюта',
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'RUB' => 'RUB',
                ];
                break;
            case Currency::TYPE_METAL:
                $title = KeyValue::findOne(['key' => 'currency_metal_title_page'])->value;
                foreach ($rates as $rate) {
                    $rates_body[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->name,
                        'char_code' => $rate->currencyFrom->char_code,
                        'rate' => $rate->rate
                    ];
                }
                $rates_title = [
                    'char_code' => 'Цифр. код',
                    'currency' => 'Валюта',
                    'rate' => 'Единиц',
                ];
                break;
            default:
                $title = KeyValue::findOne(['key' => 'currency_title_page'])->value;
                foreach ($rates as $rate) {
                    $rates_body[$rate->currency_from_id] = [
                        'char_code' => $rate->currencyFrom->char_code,
                        'currency' => $rate->currencyFrom->name,
                        'rate' => $rate->rate
                    ];
                }
                $rates_title = [
                    'char_code' => 'Цифр. код',
                    'currency' => 'Валюта',
                    'rate' => 'Единиц',
                ];
        }
        return $this->render('currency', [
            'rates_title' => $rates_title,
            'rates_body' => $rates_body,
            'title' => $title,
        ]);
    }
}