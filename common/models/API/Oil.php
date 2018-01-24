<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 24.01.2018
 * Time: 10:13
 */

namespace common\models\API;

use yii\db\Expression;
use common\models\db\Currency as DbCurrency;
use PhpQuery\PhpQuery as phpQuery;

class Oil extends ApiCurrencyAbstract
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
        $ch = curl_init();
        $url = 'https://www.bloomberg.com/energy';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        curl_close($ch);

        $document = phpQuery::newDocumentHTML($html);
        $petroleum = $document
            ->find('.section-front__main-content > .data-tables:first')
            ->find('.data-table-body');
        $oil['value'] = $petroleum
            ->find('tr:eq(1) > td[data-type="value"]')
            ->html();
        $oil['name'] = $petroleum
            ->find('tr:eq(1) > td[data-type="name"])')
            ->find('.data-table-row-cell__link-block:eq(1)')
            ->html();
        phpQuery::unloadDocuments();
        unset($petroleum);
        unset($document);

        return $oil;
    }

    public function getData()
    {
        $array = $this->fetchData();
        if ($array == false) {
            return false;
        } else {
            $name = trim($array['name']);
            $currency_list = $rates = [];
            $currency_list[0]['code'] = 0;
            $currency_list[0]['char_code'] = explode(" ",$name)[0];
            $currency_list[0]['name'] = $name;
            $currency_list[0]['status'] = DbCurrency::STATUS_ACTIVE;
            $currency_list[0]['type'] = DbCurrency::TYPE_GSM;

            $rates[0]['date'] = new Expression('CURDATE()');
            $rates[0]['currency_to_id'] = DbCurrency::USD_ID;
            $rates[0]['rate'] = (float)$array['value'];

            return ['currencies' => $currency_list, 'rates' => $rates];
        }
    }

}