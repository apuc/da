<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 18.11.2017
 * Time: 18:21
 */

namespace common\models\API;

use common\classes\Debug;
use yii\db\Expression;
use yii\helpers\Json;
use common\models\db\Currency as DbCurrency;


class Currency extends ApiCurrencyAbstract
{
    protected function fetchData()
    {
        if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'))
            return $json_daily;
        else return false;
    }

    protected function getData()
    {
        $array = Json::decode($this->fetchData(), false);
        $currency_list = $rates = [];
        foreach ($array->Valute as $currency) {
            $currency_list[$currency->NumCode]['name'] = $currency->Name;
            $currency_list[$currency->NumCode]['code'] = $currency->NumCode;
            $currency_list[$currency->NumCode]['char_code'] = $currency->CharCode;
            if (isset($currency->Nominal)) $currency_list[$currency->NumCode]['nominal'] = $currency->Nominal;
            $currency_list[$currency->NumCode]['status'] = DbCurrency::STATUS_ACTIVE;
            $currency_list[$currency->NumCode]['type'] = DbCurrency::TYPE_CURRENCY;

            $rates[$currency->NumCode]['date'] = new Expression('CURDATE()');
            $rates[$currency->NumCode]['currency_to_id'] = DbCurrency::RUB_ID;
            $rates[$currency->NumCode]['rate'] = $currency->Value;
        }

        return ['currencies' => $currency_list, 'rates' => $rates];
    }


}