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
        $ch = curl_init();
        $url = 'https://oilprice.com/oil-price-charts';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        curl_close($ch);

        $document = phpQuery::newDocumentHTML($html);
        $petroleum = $document->find('.oilprices__table > .row_holder');
        $ids = [67, 4183, 4410, 45, 46];
        $oil = [];
        foreach ($ids as $key => $id) {
            $pet = $petroleum->find('tr[data-id=' . $id . ']');
            $oil[$key]['name'] = $pet->find('td:eq(1)')->text();
            $oil[$key]['value'] = $pet->find('td.last_price')->text();
        }
        unset($pet);
        unset($petroleum);
        phpQuery::unloadDocuments($document);
        return $oil;
    }

    public function getData()
    {
        $array = $this->fetchData();
        if ($array == false) {
            return false;
        } else {
            $currency_list = $rates = [];
            foreach ($array as $key => $item) {
                $code = 1000000 + $key;
                $currency_list[$code]['code'] = $code;
                $currency_list[$code]['char_code'] = trim($array[$key]['name']);
                $currency_list[$code]['name'] = 'Нефть';
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