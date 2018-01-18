<?php

namespace frontend\modules\currency\controllers;

use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use common\models\db\KeyValue;
use common\models\Time;
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
    public function actionIndex($type = Currency::TYPE_CURRENCY)
    {
        $keyVal = KeyValue::find()->all();
        $meta = ArrayHelper::index($keyVal, 'key');
        //выборка последней даты по типу Валюты(ценности)
        $date = CurrencyRate::find()
            ->joinWith(['currencyFrom cf'])
            ->where([
                'between',
                'date',
                new Expression('CURDATE()-INTERVAL 1 DAY'),
                new Expression('CURDATE()')
            ])
            ->andWhere(['cf.type' => $type])
            ->orderBy('date DESC')
            ->one();
        $date_prev = CurrencyRate::find()
            ->joinWith(['currencyFrom cf'])
            ->andWhere(['cf.type' => $type])
            ->andWhere(['<', 'date', $date->date])
            ->orderBy('date DESC')
            ->one();
        if (empty($date)) $date = new Expression('CURDATE()');
        switch ($type) {
            case Currency::TYPE_COIN:
                $meta_title = $meta['currency_coin_title_page']->value;
                $meta_descr = $meta['currency_coin_desc_page']->value;
                $top = [Currency::BTC_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => $type,
                        'date' => $date
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE_FOR_COIN])
                    ->andWhere(['!=', 'ct.id', Currency::UAH_ID])
                    ->all();
                $rates_list = $top_rates = [];
                foreach ($rates as $rate) {
                    if (!isset($rates_list[$rate->currency_from_id])) $rates_list[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->coin->full_name,
//                        'algo' => $rate->currencyFrom->coin->algorithm,
//                        'total' => $rate->currencyFrom->coin->total_coin_supply,
                        'USD' => null,
                        'EUR' => null,
                        'RUB' => null
                    ];
                    $rates_list[$rate->currency_from_id][$rate->currencyTo->char_code] =
                        rtrim(number_format($rate->rate, 6, '.', ' '), "0");

                    if (in_array($rate->currency_from_id, $top) && $rate->currency_to_id == Currency::USD_ID)
                        $top_rates[] = [$rate->currencyFrom->name, ('$' . $rate->rate)];
                }
                $rates_list = [
                    'titles' => [
                        'name' => [
                            'value' => 'Название',
                            'class' => 'digital-code'
                        ],
//                        'algo' => [
//                            'value' => 'Алгоритм расчета',
//                            'class' => 'letter-code'
//                        ],
//                        'total' => [
//                            'value' => 'В наличии',
//                            'class' => 'nominal'
//                        ],
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

            case Currency::TYPE_METAL:
                $meta_title = $meta['currency_metal_title_page']->value;
                $meta_descr = $meta['currency_metal_desc_page']->value;
                $top = [Currency::AU_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => $type,
                        'date' => $date
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE])
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
                $meta_title = $meta['currency_title_page']->value;
                $meta_descr = $meta['currency_desc_page']->value;
                $top = [Currency::USD_ID, Currency::EUR_ID];
                $rates = CurrencyRate::find()
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => $type,
                        'date' => $date
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE])
                    ->all();
                $rates_prev = CurrencyRate::find()
                    ->select('rate')
                    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
                    ->where([
                        'cf.type' => $type,
                        'date' => $date_prev
                    ])
                    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
                    ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE])
                    ->column();
                $rates_list = $top_rates = [];
                foreach ($rates as $key => $rate) {
                    $rates_list[$rate->currency_from_id] = [
                        'char_code' => $rate->currencyFrom->char_code,
                        'nominal' => $rate->currencyFrom->nominal,
                        'currency' => $rate->currencyFrom->name,
                        'rate' => [
                            'now' => $rate->rate,
                            'diff' => number_format($rates_prev[$key] - $rate->rate, 4),
                        ],
                    ];
                    if (in_array($rate->currency_from_id, $top) && $rate->currency_to_id == Currency::RUB_ID)
                        $top_rates[] = [$rate->currencyFrom->name, ($rate->rate . ' Р')];
                }
                $rates_list = [
                    'titles' => [
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
        return $this->render('index', [
            'top_rates' => $top_rates,
            'rates' => $rates_list,
            'meta_title' => $meta_title,
            'meta_descr' => $meta_descr,
            'date' => $date
        ]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionConverter()
    {
        $keyVal = KeyValue::find()->all();
        $meta = ArrayHelper::index($keyVal, 'key');
        $model = Currency::findAll(['type' => Currency::TYPE_CURRENCY]);
        $currency = ArrayHelper::map($model, 'char_code', 'name');
        array_walk($currency, function (&$value, $key) {
            $value = $key . ' - ' . $value;
        });
        return $this->render('converter', [
            'currency' => $currency,
            'meta_title' => $meta['currency_converter_title_page']->value,
            'meta_descr' => $meta['currency_converter_desc_page']->value
        ]);
    }

    /**
     * @return string
     */
    public function actionAll()
    {
        $keyVal = KeyValue::find()->all();
        $meta = ArrayHelper::index($keyVal, 'key');
        return $this->render('all', [
            'meta_title' => $meta['currency_title_all']->value,
            'meta_descr' => $meta['currency_desc_all']->value,
        ]);
    }

    /**
     * @return bool|string
     */
    public function actionCalculate()
    {
        $date = CurrencyRate::find()
            ->joinWith(['currencyFrom cf'])
            ->where(['cf.type' => Currency::TYPE_CURRENCY])
            ->orderBy('date DESC')
            ->one();

        if (Yii::$app->request->isAjax) {
            $array = Yii::$app->request->post();
            $to = $array['toCurrency'];
            $idTo = Currency::findOne(['char_code' => $to]);
            $modelFirst = CurrencyRate::find()->with('currencyFrom')->where([
                'currency_from_id' => $idTo->id,
                'currency_to_id' => Currency::RUB_ID,
                'date' => $date
            ])->one();

            $key = $to . '_' . date('d-m-Y', time());
            Yii::$app->cache->set($key, $modelFirst, 3600);
            if ($model = Yii::$app->cache->get($key)) {
                if ($array['rub'] === 'true' && $array['fromVal'] != "NaN") {
                    if (empty($array['fromVal'])) return 0;
                    $val = $array['fromVal'];
                    $res = $val * $model->currencyFrom->nominal / $model->rate;
                    $length = 2;
                    if (strlen(strval($val)) > 6) {
                        $length = 0;
                    }

                    return number_format($res, $length, '.', '');
                } elseif ($array['toVal'] != "NaN") {
                    if (empty($array['toVal'])) return 0;
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
