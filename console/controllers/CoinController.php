<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 09.11.2017
 * Time: 20:37
 */

namespace console\controllers;


use common\models\db\Coin;
use yii\console\Controller;
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
            $model = new Coin();
            $model->coin_id = $coin->Id;
            $model->url = $coin->Url;
            if (isset($coin->ImageUrl)) {
                $model->image_url = $coin->ImageUrl;
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
        $this->stdout("write $counter notes \n", Console::FG_GREEN);
        if (count($fails) !== 0) {
            foreach ($fails as $fail) {
                $this->stdout("not write coin_id $fail \n", Console::FG_RED);
            }
        }
    }
}