<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 20.11.2017
 * Time: 10:13
 */

namespace common\models\API;


use common\classes\Debug;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\db\Currency as DbCurrency;

class Metal extends ApiCurrencyAbstract
{
    public function fetchData()
    {
        $date = $response = 0;
        while (!isset($response->Record)) {
            $ch = curl_init();
            $dateT = date("d/m/Y", strtotime(date("Y-m-d") . "-$date day"));
            $url = "http://www.cbr.ru/scripts/xml_metall.asp?date_req1=" . $dateT . "&date_req2=" . $dateT;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            if ($data != false) {
                $response = simplexml_load_string($data);
            } else {
                $response = false;
            }
            curl_close($ch);
            $date++;
        };
        return $response;
    }

    public function getData()
    {
        $xml = $this->fetchData();
        if ($xml == false) {
            return false;
        } else {
            $currency_list = $rates = [];
            $array = json_decode(json_encode($xml), true);
            foreach ($array['Record'] as $item) {
                $currency_list[$item['@attributes']['Code']]['code'] = $code = $item['@attributes']['Code'];
                $currency_list[$item['@attributes']['Code']]['char_code'] = ArrayHelper::getValue(DbCurrency::getCharMetals(), $code);
                $currency_list[$item['@attributes']['Code']]['name'] = ArrayHelper::getValue(DbCurrency::getNameMetals(), $code);
                $currency_list[$item['@attributes']['Code']]['status'] = DbCurrency::STATUS_ACTIVE;
                $currency_list[$item['@attributes']['Code']]['type'] = DbCurrency::TYPE_METAL;

                $rates[$item['@attributes']['Code']]['date'] = new Expression('CURDATE()');
                $rates[$item['@attributes']['Code']]['currency_to_id'] = DbCurrency::RUB_ID;
                $rates[$item['@attributes']['Code']]['rate'] = str_replace(',', '.', $item['Sell']);
            }
            return ['currencies' => $currency_list, 'rates' => $rates];
        }
    }

}