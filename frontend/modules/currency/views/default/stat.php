<?php


use common\classes\Debug;
use miloschuman\highcharts\Highcharts;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

$countVision = (new Query())
    ->select([
        'company_id',
        'date' => new Expression("DATE(`date`)"),
        'sum' => new Expression("SUM(`count`)"),
        'unique' => new Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->where(['company_id' => 13])
    ->groupBy([
        new Expression("DATE(`date`)"),
        'company_id',
    ])
    ->all();
//    ->createCommand()
//    ->rawSql;
//Debug::dd($countVision);

$optionsCV = [
    'options' => [
        'chart' => [
            'type' => 'areaspline',
//            'height' => 280
        ],
        'title' => ['text' => 'Просмотры'],
        'xAxis' => [
            'categories' => ArrayHelper::getColumn($countVision, function ($item) {
                return $item['date'];
            }
            )
        ],
        'yAxis' => [
            'title' => ['text' => 'Количество просмотров']
        ],
        'series' => [
            [
                'name' => 'Общие',
//                'color' => '#ee2e24',
                'color' => '#ff0200',
                'data' => ArrayHelper::getColumn($countVision, function ($item) {
                    return (int)$item['sum'];
                }
                )
            ],
            [
                'name' => 'Уникальные',
                'color' => 'grey',
                'data' => ArrayHelper::getColumn($countVision, function ($item) {
                    return (int)$item['unique'];
                }
                )

            ]
        ]
    ]
];
echo Highcharts::widget($optionsCV);

$cvRegion = (new Query())
    ->select([
        'geobase_city.name',
        'sum' => new Expression("SUM(`count`)"),
        'count' => new Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->leftJoin('geobase_ip', 'ip_address BETWEEN geobase_ip.ip_begin AND geobase_ip.ip_end')
    ->leftJoin('geobase_city', 'geobase_city.id = geobase_ip.city_id')
    ->where(['company_id' => 13])
    ->groupBy([
        'geobase_ip.city_id',
    ])
    ->orderBy('sum DESC')
    ->all();
//    ->createCommand()
//    ->rawSql;


array_walk($cvRegion, function (&$item) {
    $item['name'] = is_null($item['name']) ? $item['name']= 'Не определёно' : $item['name'];
    $item['sum'] = (int)$item['sum'];
    $item = array_values($item);
});

Debug::prn($cvRegion);
$optionsCVR = [
    'options' => [
        'chart' => [
            'type' => 'pie',
            'options3d' => [
                'enabled' => true,
                'alpha' => 45,
//                'beta' => 0
            ]
        ],
        'title' => [
            'text' => 'Количество просмотров по городам за весь период времени'
        ],
//        'tooltip' => [
//            'pointFormat' => '{series.name}: <b>{point}{point.percentage:.1f}%</b>'
//        ],
        'plotOptions' => [
            'pie' => [
                'innerSize' => 100,
                'depth' => 45,
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                    'style' => [
                        'color' => new JsExpression("Highcharts.theme && Highcharts.theme.contrastTextColor") || 'black'
                    ]
                ]
            ]
        ],
        'series' => [[
            'type' => 'pie',
            'name' => 'Количество просмотров',
            'data' => $cvRegion
        ]]
    ]
];
echo Highcharts::widget($optionsCVR);


?>
