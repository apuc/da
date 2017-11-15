<?php

/** @var array $metalRates */

use common\classes\Debug;
use yii\helpers\Url;

$this->title = 'Драгоценные металлы';
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => 'Драгоценные металлы',
] );

?>
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <h1>Драгоценные металлы</h1>
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
                        <li><a href="#">Конвертер</a></li>
                    </ul>
                </div>
            </div>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2>Учетные цены ЦБ РФ на драгоценные металлы на <?= date('d.m.Y', time()) ?></h2>
                    <a href="#">Архив <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
                <div class="e-content__wrapper__info">
                    <p>
<!--                        Доллар США $ — <span>--><?//= 3 ?><!-- руб.</span>-->
                    </p>
                    <p>
<!--                        Евро € — <span>--><?//= 2 ?><!-- руб.</span>-->
                    </p>
                </div>
                <div class="e-content__wrapper__table">
                    <table>
                        <thead>
                        <tr>
                            <td>Металл</td>
                            <td>символ</td>
                            <td>цена</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($metalRates as $item) : ?>
                            <tr>
                                <td><?= $item->metal->full_name ?></td>
                                <td><?= $item->metal->name ?></td>
                                <td><?= $item->price ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <ol>
                        <li>Среднее значение по курсам крупнейших банков России</li>
                        <li>Коммерческий курс валют расчитывается на основании международного рынка форекс.</li>
                        <li>Курсы VISA обновляются один раз в день около 08:00 по Московскому времени, кроме субботы и воскресенья</li>
                    </ol>
                    <p>Обратите внимание, что курс не учитыает % комиссии банка, выпустившего карту</p>
                </div>
            </div>
        </div>
        <!-- start promotions-sidebar-right.html-->
<!--        --><?//= \frontend\widgets\ShowRightRecommend::widget() ?>
        <!-- end promotions-sidebar-right.html-->
    </div>
</section>
