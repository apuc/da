<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 28.12.2017
 * Time: 18:00
 */

/** @var integer $count_day */

use common\classes\Debug;
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
    ->andWhere(['cf.type' => Currency::TYPE_METAL])
    ->orderBy('date DESC')
    ->one();
/**     @var CurrencyRate $date */
is_null($date) ? $date = date('Y-m-d') : $date = $date->date;
$rates = CurrencyRate::find()
    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
    ->where([
        'cf.type' => Currency::TYPE_GSM,
    ])
    ->andWhere(['>=', 'cf.status', Currency::STATUS_ACTIVE])
//            ->andWhere(['>=', 'ct.status', Currency::STATUS_ACTIVE_FOR_COIN])
    ->andWhere(['ct.id' => Currency::USD_ID])
    ->andWhere(['between', 'date', date('Y-m-d', strtotime($date) - $count_day * Time::DAY), $date])
    ->all();
$data = [];
/**     @var CurrencyRate $rate */
foreach ($rates as $rate) {
    $data[$rate->currencyFrom->char_code]['name'] = $rate->currencyFrom->name;
    $data[$rate->currencyFrom->char_code]['data'][] = [strtotime($rate->date) * 1000, $rate->rate];
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
            'height' => 280
        ],
        'subtitle' => [
            'text' => 'Цена на нефть (USD/барр)',
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
            'range' => 3000,
            'maxRange' => 3000,
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
            'valuePrefix' => '$',
        ],
        'series' => [
            [
                'name' => 'Urals',
                'color' => 'black',
                'data' => $data['Urals']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, 'black'],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'ESPO',
                'visible' => false,
                'data' => $data['ESPO']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'Sokol',
                'visible' => false,
                'data' => $data['Sokol']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, new JsExpression('Highcharts.getOptions().colors[1]')],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[1]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'WTI Crude',
                'visible' => false,
                'data' => $data['WTI Crude']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, new JsExpression('Highcharts.getOptions().colors[2]')],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
            [
                'name' => 'Brent Crude',
                'visible' => false,
                'data' => $data['Brent Crude']['data'],
                'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, new JsExpression('Highcharts.getOptions().colors[3]')],
                        [1, new JsExpression('Highcharts.Color(Highcharts.getOptions().colors[3]).setOpacity(0).get("rgba")')]
                    ]
                ]
            ],
        ],
    ]
]; ?>
<div id="container-oil" class="shadow-currency">
    <?= Highstock::widget($hsOptions); ?>
</div>