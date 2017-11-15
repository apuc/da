<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 07.11.2017
 * Time: 16:10
 */

namespace console\controllers;


use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\Exchange;
use common\models\db\MetalRates;
use Yii;
use yii\console\Controller;
use yii\db\Expression;
use yii\debug\models\search\Db;
use yii\helpers\Console;

class CbrfController extends Controller
{
    protected function CBR_JSON_Daily_Ru()
    {
        if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
            return json_decode($json_daily);
        }
        return false;
    }

    public function actionIndex()
    {
        $json_daily = $this->CBR_JSON_Daily_Ru();
        $result = false;
        foreach ($json_daily->Valute as $valute) {
            if (is_null(Currency::findOne(['num_code' => $valute->NumCode]))) {
                $model = new Currency();
                $model->num_code = $valute->NumCode;
                $model->char_code = $valute->CharCode;
                $model->name = $valute->Name;
                $model->save();
                $this->stdout("add new " . $valute->CharCode . "\n", Console::FG_GREEN);
                $result = true;
            }
        }
        if (!$result) {
            $this->stdout("nothing to update \n", Console::FG_RED);
        }
    }

    public function actionGetValutes()
    {
        $json_daily = $this->CBR_JSON_Daily_Ru();
        $date = new Expression('NOW()');
        if (is_null(Exchange::findOne(['date' => date('Y-m-d', time())]))) {
            foreach ($json_daily->Valute as $valute) {
                $model = new Exchange();
                $model->num_code = $valute->NumCode;
                $model->char_code = $valute->CharCode;
                $model->nominal = $valute->Nominal;
                $model->name = $valute->Name;
                $model->value = $valute->Value;
                $model->previous = $valute->Previous;
                $model->date = $date;
                $model->save();
                $this->stdout("add new " . $valute->CharCode . "\n", Console::FG_GREEN);
            }
        } else {
            $this->stdout("nothing to update \n", Console::FG_RED);
        }
    }

    public function actionGetMetalRates()
    {
        if (!is_null(MetalRates::findOne(['date' => date('Y-m-d', time())]))) {
            $this->stdout("nothing to update \n", Console::FG_RED);
        } else {
            $date = new Expression('NOW()');
            $dateNow = date('d/m/Y', time());
            $response = file_get_contents("http://www.cbr.ru/scripts/xml_metall.asp?date_req1=" . $dateNow . "&date_req2=" . $dateNow);
            $xml = simplexml_load_string($response);
            if (isset($xml->Err)) {
                echo "$xml->Err";
            } else {
                $array = json_decode(json_encode($xml), true);
                foreach ($array['Record'] as $item) {
                    $model = new MetalRates();
                    $model->metal_id = $item['@attributes']['Code'];
                    $model->date = $date;
                    $model->price = str_replace(',', '.', $item['Sell']);
                    if (!$model->save()) {
                        Debug::prn($model->getErrors());
                    }
                }
                $this->stdout("added actual values  \n", Console::FG_GREEN);
            }
        }
    }
}