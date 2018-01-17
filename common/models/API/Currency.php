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
        $ch = curl_init();
        $url = "https://www.cbr-xml-daily.ru/daily_json.js";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        if ($data != false) {
            $response = $data;
        } else {
            $response = false;
        }
        curl_close($ch);
        return $response;
    }

    protected function getData()
    {
        $json = $this->fetchData();
        if ($json == false) {
            return false;
        } else {
            $array = Json::decode($json, false);
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

}