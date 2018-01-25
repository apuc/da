<?php

/** @var string $meta_title */
/** @var string $meta_descr */
/** @var array $economicNews */

use common\classes\Debug;
use common\models\db\Currency;
use frontend\widgets\CurrencyRates;
use yii\helpers\Url;
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
            <?= $this->render('_header', ['title' => $this->title]); ?>
            <div class="e-content__title-wrapper">
                <h2>Данные от <span><?= date('d.m.Y') ?></span> Таблица обновляется в течение дня. </h2>
            </div>
            <?= CurrencyRates::widget(); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_METAL]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_COIN]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_GSM]); ?>
            <div class="currency-news">
                <h3 class="currency-news__title">
                    Финансовые новости недели
                </h3>
                <div class="currency-news__wrapper">
                    <?php foreach ($economicNews as $economicNew) : ?>
                        <a class="currency-news__item"
                           href="<?= Url::to(['/news/default/view', 'slug' => $economicNew->slug]) ?>">
                            <div class="currency-news--date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>
                                <?= Yii::$app->formatter->asDate($economicNew->dt_public, 'long'); ?>
                                <?= date('H:i', $economicNew->dt_public) ?>
                            </span>
                            </div>
                            <div class="currency-news--text">
                                <p><?= $economicNew->title ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="promotions-sidebar">
            <?= $this->render('_currency_chart', ['count_day' => 14]); ?>
            <br>

            <?= $this->render('_coin_chart', ['count_day' => 14]); ?>
            <br>

            <?= $this->render('_metal_chart', ['count_day' => 14]); ?>
            <br>

        </div>
    </div>
</section>
