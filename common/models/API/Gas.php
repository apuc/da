<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 24.01.2018
 * Time: 10:13
 */

namespace common\models\API;

use common\classes\Debug;
use yii\db\Expression;
use common\models\db\Currency as DbCurrency;
use PhpQuery\PhpQuery as phpQuery;

class Gas extends ApiCurrencyAbstract
{
    public function fetchData()
    {
        $ch = curl_init();
        $url = 'https://ru.tradingeconomics.com/commodities';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        curl_close($ch);

        $document = phpQuery::newDocumentHTML($html);
        $tr = $document->find('table.table:first')
            ->find('tbody > tr');
        $gas = [];
        foreach ($tr as $key => $item) {
            $item = phpQuery::pq($item);
            $name = trim($item->find('td.datatable-item-first')->text());
            if ($name == 'Газ') {
                $gas[$key]['name'] = 'Природный ' . $name;
                $gas[$key]['value'] = (float)trim($item->find('td#p')->text());
            }
        }
        unset($name);
        unset($item);
        phpQuery::unloadDocuments($document);
        return $gas;
    }

    public function getData()
    {
        $array = $this->fetchData();
        if ($array == false) {
            return false;
        } else {
            $currency_list = $rates = [];
            foreach ($array as $key => $item) {
                $code = 2000000 + $key;
                $currency_list[$code]['code'] = $code;
                $currency_list[$code]['char_code'] = trim($array[$key]['name']);
                $currency_list[$code]['name'] = 'Газ';
                $currency_list[$code]['status'] = DbCurrency::STATUS_ACTIVE_FOR_WIDGET;
                $currency_list[$code]['type'] = DbCurrency::TYPE_GSM;

                $rates[$code]['date'] = new Expression('CURDATE()');
                $rates[$code]['currency_to_id'] = DbCurrency::USD_ID;
                $rates[$code]['rate'] = (float)$array[$key]['value'];
            }
            return ['currencies' => $currency_list, 'rates' => $rates];
        }
    }

}