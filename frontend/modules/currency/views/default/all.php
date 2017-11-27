<?php


use common\classes\Debug;
use common\models\db\Currency;
use frontend\widgets\CoinRates;
use frontend\widgets\CurrencyRates;
use frontend\widgets\MetalRates;
use yii\helpers\Url;

$this->title = "Валютный рынок";
$this->registerMetaTag([
    'name' => 'description',
    'content' => "Стоимость валют, криптовалют и драгметаллов",
]);

?>
<section class="currency-market">
    <div class="container">
        <h1>Валютный рынок</h1>
        <div class="e-content">
            <!--            --><? //= $this->render('_header', ['title' => $this->title]); ?>
            <?= CurrencyRates::widget(); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_COIN]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_METAL]); ?>
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


