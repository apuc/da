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
    ->andWhere(['cf.type' => Currency::TYPE_CURRENCY])
    ->orderBy('date DESC')
    ->one();
/**     @var CurrencyRate $date */
is_null($date) ? $date = date('Y-m-d') : $date = $date->date;


$rates = CurrencyRate::find()
    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
    ->where([
        'cf.type' => Currency::TYPE_CURRENCY,
        'cf.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
        'ct.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
    ])
//    ->andWhere(['!=', 'ct.id', Currency::UAH_ID])
    ->andWhere(['between', 'date', date('Y-m-d', strtotime($date) - $count_day * Time::DAY), $date])
//    ->andWhere(['date' => $date])
//    ->createCommand()->getRawSql();
    ->all();


$currencyData = [];
/**     @var CurrencyRate $rate */
foreach ($rates as $rate) {
    $currencyData[$rate->currencyFrom->char_code]['name'] = $rate->currencyFrom->name;
    $currencyData[$rate->currencyFrom->char_code]['data'][] = [strtotime($rate->date) * 1000, $rate->rate];
}



$hsOptions = [
    'setupOptions' => [
        'global' => [
            'useUTC' => false,
        ],
        'lang' => [
            'months' => [
                'Января', 'Февраля', 'Марта', 'Апреля',
                'Мая', 'Июня', 'Июля', 'Августа',
                'Сентября', 'Октября', 'Ноября', 'Декабря'
            ],
            'shortMonths' => ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            'weekdays' => [
                'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
                'Четверг', 'Пятница', 'Суббота',
            ],
            'shortWeekdays' => ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб']
        ],
    ],
    'options' => [
        'chart' => [
            'type' => 'areaspline',
            'height' => 280,
            'pinchType' => 'x'
        ],
        'subtitle' => [
            'text' => 'Курсы валют',
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
            'labelStyle' => [
                'visibility' => 'hidden'
            ]
        ],

        'yAxis' => [
//            'endOnTick' => false,
            'opposite' => false,
            'range' => 70,
            'maxRange' => 70,
            'gridLineColor' => 'red'
        ],
        'legend' => [
            'enabled' => true,
            'keyboardNavigation' => true
        ],
        'plotOptions' => [
            'series' => [
                'events' => [
                    'legendItemClick' => new JsExpression("function () {
                        var seriesIndex = this.index;
                        var series = this.chart.series;
                        for (var i = 0; i < series.length; i++) {
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
            'valueDecimals' => 2,
            'valueSuffix' => ' руб.',
        ],
        'series' => [
            [
                'name' => 'USD/руб',
                'color' => '#4caf50',
                'data' => $currencyData['USD']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, '#4caf50'],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'EUR/руб',
                'color' => '#003399',
                'visible' => false,
                'data' => $currencyData['EUR']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, '#003399'],
//                        [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ]
        ],
    ]
]; ?>
<div id="container-currency" class="shadow-currency">
    <?= Highstock::widget($hsOptions); ?>
</div>