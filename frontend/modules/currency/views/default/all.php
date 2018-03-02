<?php

/**
 * @var string $meta_title
 * @var string $meta_descr
 * @var array $economicNews
 */

use common\classes\Debug;
use common\models\db\Currency;
use frontend\widgets\CurrencyRates;
use yii\widgets\Breadcrumbs;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
$this->params['breadcrumbs'][] = 'Биржа';
?>

<section class="breadcrumbs-wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
    </div>
</section>

<section class="currency-market">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $this->title, 'coin' => false]); ?>
            <div class="e-content__title-wrapper">
                <h2>Данные от <span><?= date('d.m.Y') ?></span></h2>
            </div>
            <?= CurrencyRates::widget(); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_METAL]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_COIN]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_GSM]); ?>

            <?= $this->render('_finance_news', ['economicNews' => $economicNews]); ?>
        </div>
        <?= $this->render('_all_charts'); ?>
    </div>
</section>
