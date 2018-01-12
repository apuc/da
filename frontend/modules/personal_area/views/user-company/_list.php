<?php

use common\models\db\Company;
use common\models\db\CompanyViews;
use common\classes\Debug;
use miloschuman\highcharts\Highcharts;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * @var $model Company Object
 */


//Debug::prn($model['address']);


$countVision = (new Query())
    ->select([
        'company_id',
        'date' => new \yii\db\Expression("DATE(`date`)"),
        'sum' => new \yii\db\Expression("SUM(`count`)"),
        'unique' => new \yii\db\Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->where(['company_id' => $model->id])
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
//            'width' => 300,
//            'height' => 300
        ],
        'title' => ['text' => 'Количество просмотров'],
        'xAxis' => [
            'categories' => ArrayHelper::getColumn($countVision, function ($item) {
                return $item['date'];
            }
            )
        ],
        'yAxis' => [
            'title' => ['text' => 'Количество']
        ],
        'series' => [
            [
                'name' => 'Общие',
//                'color' => '#ee2e24',
                'color' => 'grey',
                'data' => ArrayHelper::getColumn($countVision, function ($item) {
                    return (int)$item['sum'];
                }
                )
            ],
            [
                'name' => 'Уникальные',
                'color' => '#ff0200',
                'data' => ArrayHelper::getColumn($countVision, function ($item) {
                    return (int)$item['unique'];
                }
                )

            ]
        ]
    ]
];

$cvRegion = (new Query())
    ->select([
        'geobase_city.name',
        'sum' => new \yii\db\Expression("SUM(`count`)"),
        'count' => new \yii\db\Expression("COUNT(*)")
    ])
    ->from('company_views')
    ->leftJoin('geobase_ip', 'ip_address BETWEEN geobase_ip.ip_begin AND geobase_ip.ip_end')
    ->leftJoin('geobase_city', 'geobase_city.id = geobase_ip.city_id')
    ->where(['company_id' => $model->id])
    ->groupBy([
        'geobase_ip.city_id',
    ])
    ->orderBy('sum DESC')
    ->all();
//    ->createCommand()
//    ->rawSql;


array_walk($cvRegion, function (&$item) {
    $item['name'] = is_null($item['name']) ? $item['name'] = 'Не определёно' : $item['name'];
    $item['sum'] = (int)$item['sum'];
    $item = array_values($item);
});


$optionsCVR = [
    'options' => [
        'chart' => [
            'type' => 'pie',
            'options3d' => [
                'enabled' => true,
                'alpha' => 45,
                'beta' => 0
            ],
//            'width' => 500,
//            'height' => 500
        ],
        'title' => [
            'text' => 'Количество просмотров по городам'
        ],
//        'tooltip' => [
//            'pointFormat' => '{series.name}: <b>{point}{point.percentage:.1f}%</b>'
//        ],
//        'plotOptions' => [
//            'pie' => [
//                'innerSize' => 100,
//                'depth' => 45,
//                'allowPointSelect' => true,
//                'cursor' => 'pointer',
//                'dataLabels' => [
//                    'enabled' => true,
//                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
//                    'style' => [
//                        'color' => new \yii\web\JsExpression("Highcharts.theme && Highcharts.theme.contrastTextColor") || 'black'
//                    ]
//                ]
//            ]
//        ],
        'series' => [[
            'type' => 'pie',
            'name' => 'Количество просмотров',
            'data' => $cvRegion
        ]]
    ]
];


?>
<div class="cabinet__pkg-descr">

    <div class="cabinet__like-block--company-photo">
        <img src="<?= $model['photo'] ?>" alt="">
    </div>

    <h3 class="cabinet__like-block--company-name"><?= $model['name']; ?></h3>
    <div class="editing">
        <a href="<?= \yii\helpers\Url::to(['/company/company/update', 'id' => $model['id']]) ?>"
           class="cabinet__like-block--company-edit">редактировать</a>
        <a data-method="post" data-confirm="Вы уверены, что хотите удалить этот элемент?"
           href="<?= \yii\helpers\Url::to(['/company/company/delete', 'id' => $model['id']]) ?>"
           class="cabinet__like-block--company-remove">удалить </a>
    </div>
    <p class="cabinet__like-block--company-address"><?= $model['address']; ?></p>

</div>

<div class="cabinet__pkg-block">

    <?php if ($model['status'] == 1 || $model['status'] == 2): ?>
        <h3>Предприятие <span>на модерации</span></h3>
        <p class="notice">Ваше предприятие будет
            опубликована как только пройдет
            модерацию</p>
    <?php endif; ?>

    <?php if ($model['status'] == 0): ?>
        <?php if ($model['tariff_id'] == 0): ?>
            <a href="<?= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $model['id']]) ?>"
               class="show-more">Подключить тариф</a>
        <?php else: ?>
            <p class="cabinet__pkg-block--type">Тариф <?= $model['tariff']->name ?></p>

            <p class="cabinet__pkg-block--period"><?= \common\classes\DateFunctions::getTimeCompany($model['dt_end_tariff']); ?></p>

            <a href="<?= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $model['id']]) ?>"
               class="cabinet__like-block--company-edit">сменить тариф</a>
        <?php endif; ?>

    <?php endif; ?>

</div>

<div class="cabinet-company-statistic">
    <div class="cabinet-company-statistic__header">
        <h3>Статистика компании</h3>
        <a href="#" class="company-static-close"><i class="fa fa-angle-down" aria-hidden="true"></i>
            свернуть блок статистики</a>
    </div>
    <div class="cabinet-company-statistic__body">
        <div class="cabinet-company-statistic__body--left">
            <h4>Охват аудитории</h4>
            <p>Количество посетителей <b><?= $model->views ?></b></p>
            <p>Количество <span>уникальных</span> посетителей
                <b><?= CompanyViews::find()->where(['company_id' => $model->id])->count() ?></b></p>

            <h5>География </h5>
            <table>
                <thead>
                <tr>
                    <td>Город</td>
                    <td>Количество</td>
                </tr>
                </thead>
                <tbody>
                <?php $sum = 0;
                foreach ($cvRegion as $item) {
                    $sum += $item[1];
                } ?>
                <?php foreach ($cvRegion as $item): ?>
                    <tr>
                        <td><?= $item[0] ?></td>
                        <td><?= Yii::$app->formatter->asPercent($item[1] / $sum, 1) ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="cabinet-company-statistic__body--right" id="piechart">
            <?= Highcharts::widget($optionsCV); ?>
            <?= Highcharts::widget($optionsCVR); ?>
        </div>
    </div>
</div>
