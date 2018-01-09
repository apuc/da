<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 28.12.2017
 * Time: 18:00
 */

/** @var integer $count_day */

use common\models\db\Currency;
use common\models\db\CurrencyRate;
use common\models\Time;
use miloschuman\highcharts\Highstock;
use yii\db\Expression;
use yii\web\JsExpression;

$count_day--;
$date = CurrencyRate::find()
    ->joinWith(['currencyFrom cf'])
    ->where([
        'between',
        'date',
        new Expression('CURDATE()-INTERVAL 1 DAY'),
        new Expression('CURDATE()')
    ])
    ->andWhere(['cf.type' => Currency::TYPE_COIN])
    ->orderBy('date DESC')
    ->one();
/**     @var CurrencyRate $date */
is_null($date) ? $date = date('Y-m-d') : $date = $date->date;
$rates = CurrencyRate::find()
    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
    ->where([
        'cf.type' => Currency::TYPE_COIN,
    ])
    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
//            ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE_FOR_COIN])
    ->andWhere(['ct.id' => Currency::USD_ID])
    ->andWhere(['between', 'date', date('Y-m-d', strtotime($date) - $count_day * Time::DAY), $date])
    ->all();
$coinData = [];
/**     @var CurrencyRate $rate */
foreach ($rates as $rate) {
    $coinData[$rate->currencyFrom->char_code]['name'] = $rate->currencyFrom->name;
    $coinData[$rate->currencyFrom->char_code]['data'][] = [strtotime($rate->date) * 1000, $rate->rate];
} ?>
<div id="container-coin" style="width:100%; height: 100%;">
    <?= Highstock::widget([
    'options' => [
        'chart' => [
            'type' => 'areaspline',
            'height' => 280
        ],
        'subtitle' => [
            'text' => 'Криптовалюты',
        ],
        'rangeSelector' => [
            'selected' => 1,
            'verticalAlign' => 'bottom',
            'inputEnabled' => false,
            'allButtonsEnabled' => true,
            'buttons' => [
                [
                    'type' => 'week',
                    'count' => 1,
                    'text' => 'Неделя',
                ],
                [
                    'type' => 'week',
                    'count' => 2,
                    'text' => '2 недели',
                ],
            ],
            'buttonTheme' => [ // styles for the buttons
                'fill' => 'none',
                'width' => 60,
                'stroke' => 'none',
                'stroke-width' => 0,
                'r' => 8,
                'style' => [
                    'color' => 'red',
                    'fontWeight' => 'bold'
                ],
                'states' => [
                    'hover' => [
                        'fill' => 'red',
                        'style' => [
                            'color' => 'white'
                        ]
                    ],
                    'select' => [
                        'fill' => 'red',
                        'style' => [
                            'color' => 'white'
                        ]
                    ]
                    // disabled: { ... }
                ],
            ],
        ],

        'yAxis' => [
//            'endOnTick' => false,
            'opposite' => false,
            'range' => 110000,
            'maxRange' => 100000000,
            'gridLineColor' => 'red'
        ],
        'legend' => [
            'enabled' => true,
            'keyboardNavigation' => true
        ],
        'plotOptions' => [
            'series' => [
                'events' => [
                    'legendItemClick' => new JsExpression("function (event) {
                    var seriesIndex = this.index;
                    var series = this.chart.series;
                    for (var i = 0; i < series.length; i++)
                    {
                        if (series[i].index != seriesIndex) {
                            series[i].hide();
                        }
                        else {
                            series[i].show();
                            this.chart.yAxis[0].setExtremes(this.dataMin, this.dataMax);
                        }   
                    }
                    return false;
                }")
                ]
            ]
        ],
        'scrollbar' => [
            'enabled' => false
        ],
        'navigator' => [
            'enabled' => false
        ],
        'tooltip' => [
            'valueDecimals' => 0,
            'valuePrefix' => '$',
        ],
        'series' => [
            [
                'name' => 'BTC',
                'color' => '#ff8e13',
                'data' => $coinData['BTC']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, '#ff8e13'],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'ETH',
                'color' => '#141414',
                'visible' => false,
                'data' => $coinData['ETH']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, '#141414'],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ]
        ],
    ]
]); ?>

</div>