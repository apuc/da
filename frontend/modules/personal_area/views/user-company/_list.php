<?php

use common\models\db\Company;
use common\models\db\CompanyViews;
use common\classes\Debug;
use miloschuman\highcharts\Highcharts;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * @var $model Company Object
 */


$uniqueViews = CompanyViews::find()->where(['company_id' => $model->id])->count();
//Есть ли просмотры по компаниям
$show = ((int)$model->views != 0 || (int)$uniqueViews != 0);
if ($show) {
    $countVision = (new Query())
        ->select([
            'company_id',
            'date' => new Expression("DATE(`date`)"),
            'sum' => new Expression("SUM(`count`)"),
            'unique' => new Expression("COUNT(*)")
        ])
        ->from('company_views')
        ->where(['company_id' => $model->id])
        ->groupBy([
            new Expression("DATE(`date`)"),
            'company_id',
        ])
        ->all();

    $optionsCV = [
        'options' => [
            'chart' => [
                'type' => 'areaspline',
            ],
            'title' => ['text' => 'Количество посетителей'],
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
            '`gc`.`name`',
            '`sum`' => new Expression("SUM(`count`)"),
            '`count`' => new Expression("COUNT(*)")
        ])
        ->from('`company_views`')
        ->leftJoin('`geobase_ip_short` AS `gis`', '`ip_address` BETWEEN `gis`.`ip_begin` AND `gis`.`ip_end`')
        ->leftJoin('`geobase_city` AS `gc`', '`gc`.`id` = `gis`.`city_id`')
        ->where(['`company_id`' => $model->id])
        ->groupBy([
            '`gis`.`city_id`',
        ])
        ->orderBy('`sum` DESC')
        ->all();


    array_walk($cvRegion, function (&$item) {
        $item['name'] = is_null($item['name']) ? $item['name'] = 'Не определено' : $item['name'];
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
            ],
            'title' => [
                'text' => 'Всего посетителей по городам'
            ],
            'series' => [[
                'type' => 'pie',
                'name' => 'Количество посетителей',
                'data' => $cvRegion
            ]]
        ]
    ];
}
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
            <?php $sum = $count = 0;
            if ($show) {
                foreach ($cvRegion as $item) {
                    $sum += $item[1];
                    $count += $item[2];
                }
            } ?>
            <p>Количество посетителей <b><?= $sum ?></b></p>
            <p>Количество <span>уникальных</span> посетителей
                <b><?= $uniqueViews ?></b></p>
            <?php if ($show) : ?>
                <h5>География </h5>
                <table style="width: 95%">
                    <thead>
                    <tr>
                        <td>Город</td>
                        <td>Общие</td>
                        <td>Уникальные</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cvRegion as $item): ?>
                        <tr>
                            <td><?= $item[0] ?></td>
                            <td><?= Yii::$app->formatter->asPercent($item[1] / $sum, 1) ?></td>
                            <td><?= Yii::$app->formatter->asPercent($item[2] / $count, 1) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="cabinet-company-statistic__body--right" id="piechart">
            <?php if ($show) {
                echo Highcharts::widget($optionsCV);
                echo Highcharts::widget($optionsCVR);
            } ?>
        </div>
    </div>
</div>
