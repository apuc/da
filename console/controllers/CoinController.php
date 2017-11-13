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
        $date = new Expression('NOW()');
        if (!is_null(CoinRates::findOne(['date' => date('Y-m-d', time())]))) {
            $this->stdout("nothing to update \n", Console::FG_RED);
        } else {
            $count = 0;
            $models = Coin::find()->select('name')->all();
            $name = array_map(function ($item) {
                $vowels = [" ", "(", ")"];
                return str_replace($vowels, "", $item->name);
            }, $models);
            $countInString = 50;
            $countStr = ceil(count($name) / $countInString);
            $urls = [];

            for ($i = 0; $i < $countStr; $i++) {
                $response = implode(',', array_slice($name, $i * $countInString, $countInString));
                $urls[] = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=" . $response . "&tsyms=USD,EUR,RUB,UAH";
            }

            $chs = [];
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
            // all of our requests are done, we can now access the results
            foreach ($chs as $item) {
                $json = curl_multi_getcontent($item);
                $resultObj = json_decode($json);
                $this->stdout(".", Console::FG_YELLOW);
                foreach ($resultObj as $key => $coin) {
                    if ($key == 'Response') {
                        if ($coin === "Error") {
                            $this->stdout("light error with message:  " . $resultObj->Message . "\n", Console::FG_RED);
                            break;
                        }
                    }
                    $model = new CoinRates();
                    $model->coin_name = $key;
                    $model->date = $date;
                    $model->usd = (isset($coin->USD) ? $coin->USD : null);
                    $model->eur = (isset($coin->EUR) ? $coin->EUR : null);
                    $model->rub = (isset($coin->RUB) ? $coin->RUB : null);
                    $model->uah = (isset($coin->UAH) ? $coin->UAH : null);
                    if (!$model->save()) {
                        Debug::prn($model->getErrors());
                    } else {
                        $count++;
                    }
                }
            }
            $this->stdout("added " . $count . " rates \n", Console::FG_GREEN);
        }
    }
}