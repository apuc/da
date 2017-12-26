<?php

/** @var string $meta_title */

/** @var string $meta_descr */

use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use frontend\widgets\CurrencyRates;
use miloschuman\highcharts\Highcharts;
use yii\db\Expression;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
//$currency = Highcharts::widget([
//    'options' => [
//        'title' => ['text' => 'Валюты'],
//        'xAxis' => [
//            'categories' => ['24.12', '25.12', '26.12']
//        ],
//        'yAxis' => [
//            'title' => ['text' => 'RUB']
//        ],
//        'series' => [
//            ['name' => 'USD', 'data' => [50, 53, 58.837]],
//            ['name' => 'EUR', 'data' => [68, 70, 69.2982]],
//            ['name' => 'UAH', 'data' => [19, 20, 21.6631]]
//        ]
//    ]
//]);
//echo $currency;
//echo $crypto;
const DAY = 24 * 60 * 60;
$days = range(time() - 7 * DAY, time(), DAY);
//var_dump($days);
//foreach ($days as $day) {
//    echo Yii::$app->formatter->asDate($day, 'short');
//    echo "<br>";
//}

$date = CurrencyRate::find()
    ->joinWith(['currencyFrom cf'])
    ->where(['cf.type' => Currency::TYPE_CURRENCY])
    ->orderBy('date DESC')
    ->one();
if (empty($date)) $date = new Expression('CURDATE()');
$rates_body = $rates_title = [];
$rates = CurrencyRate::find()
    ->joinWith(['currencyFrom cf', 'currencyTo ct'])
    ->where([
        'cf.type' => Currency::TYPE_CURRENCY,
        'cf.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
        'ct.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
    ])
//    ->andWhere(['!=', 'ct.id', Currency::UAH_ID])
    ->andWhere(['between', 'date', date('Y-m-d', strtotime($date->date) - 7 * DAY), $date->date])
//    ->andWhere(['date' => $date])
//    ->createCommand()->getRawSql();
    ->all();
$rr = [];
foreach ($rates as $rate) {
    $rr[$rate->currencyFrom->char_code]['name'] =
//        'id' => $rate->currencyFrom->id,
//        'name' => $rate->currencyFrom->name,
        $rate->currencyFrom->name;
//        'char_code' => $rate->currencyFrom->char_code,
//        'date' => $rate->date];
    $rr[$rate->currencyFrom->char_code]['data'][] = $rate->rate;

}
array_walk($days, function ( &$item1 ) {
    $item1 = Yii::$app->formatter->asDate($item1, 'short');;
} );
$currency = Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Валюты'],
        'xAxis' => [
            'categories' => $days
        ],
        'yAxis' => [
            'title' => ['text' => 'RUB']
        ],
        'series' => [
                $rr['USD'],
                $rr['EUR'],
                $rr['UAH'],
        ]
    ]
]);

//Debug::dd($rr);
echo $currency;

?>
<section class="currency-market">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $this->title]); ?>
            <?= CurrencyRates::widget(); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_METAL]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_COIN]); ?>
            <div class="currency-widget">
                <h1>
                    Описание
                </h1>
                <ol>
                    <li>Среднее значение по курсам крупнейших
                        банков России
                    </li>
                    <li>Коммерческий курс валют расчитывается на
                        основании международного рынка форекс.
                    </li>
                    <li>Курсы VISA обновляются один раз в день около 08:00
                        по Московскому времени, кроме субботы и воскресенья
                        Обратите внимание, что курс не учитыает % комиссии банка,
                        выпустившего карту
                    </li>
                </ol>
            </div>
        </div>
        <?= \frontend\widgets\ShowRightRecommend::widget() ?>
    </div>
</section>
