<?php


use common\classes\Debug;
use miloschuman\highcharts\Highcharts;
use yii\db\Query;
use yii\helpers\ArrayHelper;

$countVision = (new Query())
    ->select([
        'company_id',
        'date' => new \yii\db\Expression("DATE(`date`)"),
        'sum' => new \yii\db\Expression("SUM(`count`)"),
        'unique' => new \yii\db\Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->where(['company_id' => 13])
    ->groupBy([
        new \yii\db\Expression("DATE(`date`)"),
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
        'sum' => new \yii\db\Expression("SUM(`count`)"),
        'count' => new \yii\db\Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->leftJoin('geobase_ip', 'ip_address BETWEEN geobase_ip.ip_begin AND geobase_ip.ip_end')
    ->leftJoin('geobase_city', 'geobase_city.id = geobase_ip.city_id')
    ->where(['company_id' => 13])
    ->groupBy([
        'geobase_ip.city_id',
    ])
    ->all();
//    ->createCommand()
//    ->rawSql;


array_walk($cvRegion, function (&$item) {
    $item['sum'] = (int)$item['sum'];
    $item = array_values($item);
});
is_null($cvRegion[0][0]) ? $cvRegion[0][0] = 'Не определёно' : $cvRegion[0][0];


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
                'depth' => 45
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
