<?php

namespace frontend\modules\currency\controllers;

use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `currency` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($type = null)
    {
        switch ($type) {
            case 'coin':
                $title = Yii::t('currency', 'Coin');
                $top = [Currency::BTC_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => Currency::TYPE_COIN,
                        'cf.status' => Currency::STATUS_ACTIVE,
                    ])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE_FOR_COIN])
                    ->andWhere(['date' => new Expression('CURDATE()')])
                    ->all();
                $rates_list = $top_rates = [];
                foreach ($rates as $rate) {
                    if (!isset($rates_list[$rate->currency_from_id])) $rates_list[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->coin->full_name,
                        'algo' => $rate->currencyFrom->coin->algorithm,
                        'total' => $rate->currencyFrom->coin->total_coin_supply,
                        'USD' => null,
                        'EUR' => null,
                        'RUB' => null
                    ];
                    $rates_list[$rate->currency_from_id][$rate->currencyTo->char_code] = $rate->rate;

                    if (in_array($rate->currency_from_id, $top) && $rate->currency_to_id == Currency::USD_ID)
                        $top_rates[] = [$rate->currencyFrom->name, ('$' . $rate->rate)];
                }
                $rates_list = [
                    'titles' => [
                        'name' => 'Название',
                        'algo' => 'Алгоритм расчета',
                        'total' => 'В наличии',
                        'USD' => 'USD',
                        'EUR' => 'EUR',
                        'RUB' => 'RUB'
                    ],
                    'rates' => $rates_list
                ];
                break;

            case 'metal':
                $title = Yii::t('currency', 'Metal');
                $top = [Currency::AU_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => Currency::TYPE_METAL,
                        'cf.status' => Currency::STATUS_ACTIVE])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['date' => new Expression('CURDATE()')])
                    ->all();
                $rates_list = $top_rates = [];

                foreach ($rates as $rate) {
                    $rates_list[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->name,
                        'char_code' => $rate->currencyFrom->char_code,
                        'rate' => $rate->rate
                    ];

                    if (in_array($rate->currency_from_id, $top) && $rate->currency_to_id == Currency::RUB_ID)
                        $top_rates[] = [$rate->currencyFrom->name, ($rate->rate . ' Р')];
                }
                $rates_list = [
                    'titles' => [
                        'code' => 'Цифровой код',
                        'char_code' => 'Буквенный код',
                        'rate' => 'Курс'
                    ],
                    'rates' => $rates_list
                ];
                break;

            default:
                $title = Yii::t('currency', 'Currency');
                $top = [Currency::USD_ID, Currency::EUR_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => Currency::TYPE_CURRENCY,
                        'cf.status' => Currency::STATUS_ACTIVE,
                    ])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['date' => new Expression('CURDATE()')])
                    ->all();
                $rates_list = $top_rates = [];
                foreach ($rates as $rate) {
                    $rates_list[$rate->currency_from_id] = [
                        'code' => $rate->currencyFrom->code,
                        'char_code' => $rate->currencyFrom->char_code,
                        'nominal' => $rate->currencyFrom->nominal,
                        'currency' => $rate->currencyFrom->name,
                        'rate' => $rate->rate
                    ];
                    if (in_array($rate->currency_from_id, $top) && $rate->currency_to_id == Currency::RUB_ID)
                        $top_rates[] = [$rate->currencyFrom->name, ($rate->rate . ' Р')];
                }
                $rates_list = [
                    'titles' => [
                        'code' => 'Цифровой код',
                        'char_code' => 'Буквенный код',
                        'nominal' => 'Номинал',
                        'currency' => 'Валюта',
                        'rate' => 'Курс'
                    ],
                    'rates' => $rates_list
                ];
        }
        return $this->render('index', ['top_rates' => $top_rates, 'rates' => $rates_list, 'title' => $title]);
    }
}
