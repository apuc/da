<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 09.11.2017
 * Time: 20:37
 */

namespace console\controllers;


use backend\modules\coin\models\CoinSearch;
use common\classes\Debug;
use common\models\db\Coin;
use common\models\db\CoinRates;
use yii\console\Controller;
use yii\db\Expression;
use yii\helpers\Console;

class CoinController extends Controller
{
    public function actionIndex()
    {
        $json_daily = file_get_contents('https://www.cryptocompare.com/api/data/coinlist/');
        if (is_null($json_daily)) {
            $this->stdout("fail response from server \n", Console::FG_RED);
            die();
        }
        $cryptoCompare = json_decode($json_daily);
        $counter = 0;
        $fails = [];
        foreach ($cryptoCompare->Data as $coin) {
            if (is_null(Coin::findOne(['coin_id' => $coin->Id]))) {
                $model = new Coin();
                $model->coin_id = $coin->Id;
                $model->url = 'https://www.cryptocompare.com' . $coin->Url;
                if (isset($coin->ImageUrl)) {
                    $model->image_url = 'https://www.cryptocompare.com' . $coin->ImageUrl;
                } else {
                    $model->image_url = null;
                }
                $model->name = $coin->Name;
                $model->symbol = $coin->Symbol;
                $model->coin_name = $coin->CoinName;
                $model->full_name = $coin->FullName;
                if ($coin->Algorithm != "N/A") {
                    $model->algorithm = $coin->Algorithm;
                } else {
                    $model->algorithm = null;
                }
                if ($coin->ProofType != "N/A") {
                    $model->proof_type = $coin->ProofType;
                } else {
                    $model->proof_type = null;
                }
                $model->fully_premined = $coin->FullyPremined;
                if ($coin->TotalCoinSupply != "N/A") {
                    $model->total_coin_supply = $coin->TotalCoinSupply;
                } else {
                    $model->total_coin_supply = null;
                }
                if ($coin->PreMinedValue != "N/A") {
                    $model->pre_mined_value = $coin->PreMinedValue;
                } else {
                    $model->pre_mined_value = null;
                }
                if ($coin->TotalCoinsFreeFloat != "N/A") {
                    $model->total_coins_free_float = $coin->TotalCoinsFreeFloat;
                } else {
                    $model->total_coins_free_float = null;
                }
                $model->sort_order = $coin->SortOrder;
                if ($coin->Sponsored == false) {
                    $model->sponsored = 0;
                } else {
                    $model->sponsored = 1;
                }

                if ($model->save()) {
                    $counter++;
                } else {
                    $fails[] = $coin->Id;
                }
            }
        }
        $this->stdout("write $counter notes \n", Console::FG_GREEN);
        if (count($fails) !== 0) {
            foreach ($fails as $fail) {
                $this->stdout("not write coin_id $fail \n", Console::FG_RED);
            }
        }
    }

    public function actionRates()
    {
        $searchModel = new CoinSearch();
        $dataProvider = $searchModel->searchField('name');
        $models = $dataProvider->getModels();
        $name = array_map(function ($item) {
            $vowels = [" ", "(", ")"];
            return str_replace($vowels, "", $item->name);
        }, $models);
        $countStr = ceil(count($name) / 50);
        $finAr = [];

        for ($i = 0; $i < $countStr; $i++) {
            $res = implode(',', array_slice($name, $i * 50, 50));
            $json_daily = file_get_contents('https://min-api.cryptocompare.com/data/pricemulti?fsyms=' . $res . '&tsyms=USD,EUR,RUB,UAH');
            $finAr = array_merge($finAr, json_decode($json_daily, true));
        }

        $date = new Expression('NOW()');
        if (is_null(CoinRates::findOne(['date' => date('Y-m-d', time())]))) {
            foreach ($finAr as $key => $coin) {
                $model = new CoinRates();
                $model->coin_name = $key;
                $model->date = $date;
                $model->usd = $coin['USD'];
                echo "$key";
                if (isset($coin['EUR'])) {
                    $model->eur = $coin['EUR'];
                } else {
                    $model->eur = null;
                }
                if (isset($coin['RUB'])) {
                    $model->rub = $coin['RUB'];
                } else {
                    $model->rub = null;
                }
                if (isset($coin['UAH'])) {
                    $model->uah = $coin['UAH'];
                } else {
                    $model->uah = null;
                }
                if (!$model->save()) {
                    $model->getErrors();
                }
                $this->stdout("add new " . $key . "\n", Console::FG_GREEN);
            }
        } else {
            $this->stdout("nothing update \n", Console::FG_RED);
        }
    }
}