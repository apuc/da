<?php

/** @var array $currency */


use common\classes\Debug;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Конвертер';
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => 'Конвертер',
] );


$this->registerJsFile('/js/converter.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <h1>Конвертер</h1>
            <div class="e-content__header">
                <div class="e-content__header__left">
                    <ul>
                        <li><a href="#">Регион |</a></li>
                        <li><a href="">Банки |</a></li>
                        <li><a href="">ЦРБ |</a></li>
                        <li><a href="">Разные</a></li>
                    </ul>
                </div>
                <div class="e-content__header__right">
                    <ul>
                        <li><a href="<?= Url::to('exchange') ?>">Валюта</a></li>
                        <li><a href="<?= Url::to('metal_rates') ?>">Металлы</a></li>
                        <li><a href="#">Новости</a></li>
                        <li><a href="<?= Url::to('coin') ?>">Криптовалюта</a></li>
                        <li><a href="<?= Url::to('converter') ?>">Конвертер</a></li>
                    </ul>
                </div>
            </div>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2>Конвертер</h2>
                    <a href="#">Архив <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
                <div class="e-content__wrapper__info">
                    <p>
<!--                        Bitcoin — <span>--><?//= $bitcoin ?><!-- $</span>-->
                    </p>
                    <p>
<!--                        Ethereum — <span>--><?//= $ethereum ?><!-- $</span>-->
                    </p>
                </div>
                <div class="e-content__wrapper__table">
                    <div>
                    <?= Html::dropDownList(
                        'from[currency]',
                        'RUB',
                       ['RUB' => 'RUB - Российский рубль'])
                    ?>
                    <input id="from" type="number" min="0"  name="from[value]">
                    </div>
                    <div>
                    <?= Html::dropDownList(
                        'to[currency]',
                        'USD',
                        $currency)
                    ?>
                    <input id="to" type="number" min="0" name="to[value]">
                    </div>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <ol>
                        <li>Среднее значение по курсам крупнейших банков России</li>
                        <li>Коммерческий курс валют расчитывается на основании международного рынка форекс.</li>
                        <li>Курсы VISA обновляются один раз в день около 08:00 по Московскому времени, кроме субботы и
                            воскресенья
                        </li>
                    </ol>
                    <p>Обратите внимание, что курс не учитыает % комиссии банка, выпустившего карту</p>
                </div>
            </div>
        </div>
        <!-- start promotions-sidebar-right.html-->
        <!-- end promotions-sidebar-right.html-->
    </div>
</section>



