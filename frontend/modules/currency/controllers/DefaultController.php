<?php

namespace frontend\modules\currency\controllers;

use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
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
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
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
                        'name' => [
                            'value' => 'Название',
                            'class' => 'digital-code'
                        ],
                        'algo' => [
                            'value' => 'Алгоритм расчета',
                            'class' => 'letter-code'
                        ],
                        'total' => [
                            'value' => 'В наличии',
                            'class' => 'nominal'
                        ],
                        'USD' => [
                            'value' => 'USD',
                            'class' => 'course'
                        ],
                        'EUR' => [
                            'value' => 'EUR',
                            'class' => 'course'
                        ],
                        'RUB' => [
                            'value' => 'RUB',
                            'class' => 'course'
                        ],
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
                        'code' => [
                            'value' => 'Цифровой код',
                            'class' => 'digital-code'
                        ],
                        'char_code' => [
                            'value' => 'Буквенный код',
                            'class' => 'letter-code'
                        ],
                        'rate' => [
                            'value' => 'Курс',
                            'class' => 'course'
                        ],
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
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
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
                        'code' => [
                            'value' => 'Цифровой код',
                            'class' => 'digital-code',
                        ],
                        'char_code' => [
                            'value' => 'Буквенный код',
                            'class' => 'letter-code',
                        ],
                        'nominal' => [
                            'value' => 'Номинал',
                            'class' => 'nominal',
                        ],
                        'currency' => [
                            'value' => 'Валюта',
                            'class' => 'currency',
                        ],
                        'rate' => [
                            'value' => 'Курс',
                            'class' => 'course',
                        ],
                    ],
                    'rates' => $rates_list
                ];
        }
        return $this->render('index', ['top_rates' => $top_rates, 'rates' => $rates_list, 'title' => $title]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionConverter()
    {
        $model = Currency::findAll(['type' => Currency::TYPE_CURRENCY]);
        $currency = ArrayHelper::map($model, 'char_code', 'name');
        array_walk($currency, function (&$value, $key) {
            $value = $key . ' - ' . $value;
        });
        return $this->render('converter', compact('currency'));
    }

    /**
     * @return bool|string
     */
    public function actionCalculate()
    {
        if (Yii::$app->request->isAjax) {
            $array = Yii::$app->request->post();
            $to = $array['toCurrency'];
            $idTo = Currency::findOne(['char_code' => $to]);
            $modelFirst = CurrencyRate::find()->with('currencyFrom')->where([
                'currency_from_id' => $idTo->id,
                'currency_to_id' => Currency::RUB_ID,
                'date' => new Expression('CURDATE()')
            ])->one();

            $key = $to . '_' . date('d-m-Y', time());
            Yii::$app->cache->set($key, $modelFirst, 3600);
            if ($model = Yii::$app->cache->get($key)) {
                if ($array['rub'] === 'true' && $array['fromVal'] != "NaN") {
                    $val = $array['fromVal'];
                    $res = $val * $model->currencyFrom->nominal / $model->rate;
                    $length = 2;
                    if (strlen(strval($val)) > 6) {
                        $length = 0;
                    }

                    return number_format($res, $length, '.', '');
                } elseif ($array['toVal'] != "NaN") {
                    $val = $array['toVal'];
                    $res = $val * $model->rate / $model->currencyFrom->nominal;
                    $length = 2;
                    if (strlen(strval($val)) > 6) {
                        $length = 0;
                    }
                    return number_format($res, $length, '.', '');
                }
            }
        }
        return false;
    }
}
