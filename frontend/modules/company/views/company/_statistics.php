<?php

/**
 * @var string $uniqueViews
 * @var array $optionsCVR
 * @var array $optionsCVR
 * @var array $cvRegion
 * @var boolean $show
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
                <?php $sum = $count = 0;
                if ($show) {
                    foreach ($cvRegion as $item) {
                        $sum += $item[1];
                        $count += $item[2];
                    }
                } ?>
                <p>Количество посетителей <b><?= $sum ?></b></p>
                <p>Количество <span>уникальных</span> посетителей <b><?= $uniqueViews ?></b></p>
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
</div>