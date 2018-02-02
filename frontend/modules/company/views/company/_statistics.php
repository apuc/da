<?php

/**
 * @var integer $allViews
 * @var integer $uniqueViews
 * @var array $optionsCVR
 * @var array $optionsCVR
 * @var array $countViewsRegion
 */

use miloschuman\highcharts\Highcharts;

?>
<div id="statistics" class="business__tab-content--wrapper">
    <div class="cabinet-company-statistic">
        <div class="cabinet-company-statistic__header">
            <h3>Статистика компании</h3>
        </div>
        <div class="cabinet-company-statistic__body">
            <div class="cabinet-company-statistic__body--left">
                <h4>Охват аудитории</h4>
                <p>Количество посетителей <b><?= $allViews ?></b></p>
                <p>Количество <span>уникальных</span> посетителей <b><?= $uniqueViews ?></b></p>
                <?php if ($allViews) : ?>
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
                        <?php foreach ($countViewsRegion as $item): ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= Yii::$app->formatter->asPercent($item[1] / $allViews, 1) ?></td>
                                <td><?= Yii::$app->formatter->asPercent($item[2] / $uniqueViews, 1) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <div class="cabinet-company-statistic__body--right" id="piechart">
                <?php if ($allViews) {
                    echo Highcharts::widget($optionsCV);
                    echo Highcharts::widget($optionsCVR);
                } ?>
            </div>
        </div>
    </div>
</div>