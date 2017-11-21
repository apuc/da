<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 20.11.2017
 * Time: 10:12
 */

namespace common\models\API;


use common\classes\Debug;
use common\models\db\Currency as DbCurrency;
use common\models\db\CurrencyCoin;
use common\models\db\CurrencyRate;
use yii\db\Expression;


class Coin extends ApiCurrencyAbstract
{
    public function run()
    {
        $this->errors = [];
        $data = $this->getData();
        return $this->saveData($data);
    }

    public function runRates()
    {
        $this->errors = [];
        $data = $this->getRatesData();
        return $this->saveRatesData($data);
    }

    public function fetchData()
    {
        $json = file_get_contents('https://www.cryptocompare.com/api/data/coinlist/');
        return $json;
    }

    public function fetchRatesData()
    {
        $models = DbCurrency::find()->select(['id', 'char_code'])->where(['type' => DbCurrency::TYPE_COIN])->all();
        $name = array_map(function ($item) {
            $vowels = [" ", "(", ")"];
            return str_replace($vowels, "", $item->char_code);
        }, $models);
        $countInString = 50;
        $countStr = ceil(count($name) / $countInString);
        $urls = [];

        for ($i = 0; $i < $countStr; $i++) {
            $response = implode(',', array_slice($name, $i * $countInString, $countInString));
            $urls[] = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=" . $response . "&tsyms=USD,EUR,RUB,UAH";
        }
//        array_splice($urls, 1);
//        Debug::prn($urls);
//        die();

        $chs = $json = [];
        // build the individual requests, but do not execute them
        foreach ($urls as $url) {
            $chs[] = ($ch = curl_init());
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        // build the multi-curl handle, adding both $ch
        $mh = curl_multi_init();
        foreach ($chs as $item) {
            curl_multi_add_handle($mh, $item);
        }

        // execute all queries simultaneously, and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        //close the handles
        foreach ($chs as $item) {
            curl_multi_remove_handle($mh, $item);
        }

        curl_multi_close($mh);
        foreach ($chs as $item) {
            $json[] = curl_multi_getcontent($item);
        }
        return ['json' => $json, 'models' => $models];
    }

    public function getRatesData()
    {
        $cryptoRates = $this->fetchRatesData();
        foreach ($cryptoRates['json'] as $cryptoRate) {
            $resultArr = json_decode($cryptoRate, true);
            foreach ($resultArr as $key => $item) {
                $from_id = DbCurrency::find()->select('id')->where(['char_code' => $key])->one()->id;
                if (isset($item['USD'])) {
                    $rates[$from_id][DbCurrency::USD_ID]['date'] = new Expression('CURDATE()');
                    $rates[$from_id][DbCurrency::USD_ID]['currency_from_id'] = $from_id;
                    $rates[$from_id][DbCurrency::USD_ID]['currency_to_id'] = DbCurrency::USD_ID;
                    $rates[$from_id][DbCurrency::USD_ID]['rate'] = $item['USD'];
                }
                if (isset($item['EUR'])) {
                    $rates[$from_id][DbCurrency::EUR_ID]['date'] = new Expression('CURDATE()');
                    $rates[$from_id][DbCurrency::EUR_ID]['currency_from_id'] = $from_id;
                    $rates[$from_id][DbCurrency::EUR_ID]['currency_to_id'] = DbCurrency::EUR_ID;
                    $rates[$from_id][DbCurrency::EUR_ID]['rate'] = $item['EUR'];
                }
                if (isset($item['RUB'])) {
                    $rates[$from_id][DbCurrency::RUB_ID]['date'] = new Expression('CURDATE()');
                    $rates[$from_id][DbCurrency::RUB_ID]['currency_from_id'] = $from_id;
                    $rates[$from_id][DbCurrency::RUB_ID]['currency_to_id'] = DbCurrency::RUB_ID;
                    $rates[$from_id][DbCurrency::RUB_ID]['rate'] = $item['RUB'];
                }
                if (isset($item['UAH'])) {
                    $rates[$from_id][DbCurrency::UAH_ID]['date'] = new Expression('CURDATE()');
                    $rates[$from_id][DbCurrency::UAH_ID]['currency_from_id'] = $from_id;
                    $rates[$from_id][DbCurrency::UAH_ID]['currency_to_id'] = DbCurrency::UAH_ID;
                    $rates[$from_id][DbCurrency::UAH_ID]['rate'] = $item['UAH'];
                }
            }
        }
        return $rates;
    }

    public function getData()
    {
        $cryptoCompare = json_decode($this->fetchData());
        foreach ($cryptoCompare->Data as $coin) {
            $currency_list[$coin->Id]['name'] = $coin->CoinName;
            $currency_list[$coin->Id]['code'] = $coin->Id;
            $currency_list[$coin->Id]['char_code'] = $coin->Name;
            $currency_list[$coin->Id]['status'] = DbCurrency::STATUS_ACTIVE;
            $currency_list[$coin->Id]['type'] = DbCurrency::TYPE_COIN;

            $currency_list[$coin->Id]['coin']['url'] = 'https://www.cryptocompare.com' . $coin->Url;
            $currency_list[$coin->Id]['coin']['image_url'] = isset($coin->ImageUrl) ? 'https://www.cryptocompare.com' . $coin->ImageUrl : null;
            $currency_list[$coin->Id]['coin']['symbol'] = $coin->Symbol;
            $currency_list[$coin->Id]['coin']['full_name'] = $coin->FullName;
            $currency_list[$coin->Id]['coin']['algorithm'] = ($coin->Algorithm != "N/A") ? $coin->Algorithm : null;
            $currency_list[$coin->Id]['coin']['proof_type'] = ($coin->ProofType != "N/A") ? $coin->ProofType : null;
            $currency_list[$coin->Id]['coin']['fully_premined'] = $coin->FullyPremined;
            $currency_list[$coin->Id]['coin']['total_coin_supply'] = ($coin->TotalCoinSupply != "N/A") ? $coin->TotalCoinSupply : null;
            $currency_list[$coin->Id]['coin']['pre_mined_value'] = ($coin->PreMinedValue != "N/A") ? $coin->PreMinedValue : null;
            $currency_list[$coin->Id]['coin']['total_coins_free_float'] = ($coin->TotalCoinsFreeFloat != "N/A") ? $coin->TotalCoinsFreeFloat : null;
            $currency_list[$coin->Id]['coin']['sort_order'] = $coin->SortOrder;
            $currency_list[$coin->Id]['coin']['sponsored'] = ($coin->Sponsored == 'true') ? 1 : 0;
        }
        return $currency_list;
    }

    public function saveCoinData($id, $coin)
    {
        $model = CurrencyCoin::findOne(['currency_id' => $id]);
        if (is_null($model)) {
            $model = new CurrencyCoin();
            $model->currency_id = $id;
            $model->attributes = $coin;
            if (!$model->save())
                $this->errors[$id] = $model->getErrors();
        }
    }

    protected function saveData($data)
    {
        if (!empty($data) && is_array($data)) {
            $ids = [];
            foreach ($data as $item) {
                $model = DbCurrency::findOne(['code' => $item['code']]);
                if (is_null($model)) {
                    $model = new DbCurrency();
                    $model->attributes = $item;
                    if (!$model->save())
                        $this->errors[$item['code']] = $model->getErrors();
                }
                if ($model->id) {
                    $ids[$item['code']] = $model->id;
                    if (isset($item['coin']))
                        $this->saveCoinData($model->id, $item['coin']);
                }
            }
            return empty($this->errors);
        }
        return false;
    }

    protected function saveRatesData($data)
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $code => $rate) {
                foreach ($rate as $item) {
                    $item['currency_from_id'] = $code;
                    $model = new CurrencyRate();
                    $model->attributes = $item;
                    if (!$model->save())
                        $this->errors[$code] = $model->getErrors();
                }
            }
            return empty($this->errors);
        }
        return false;
    }
}