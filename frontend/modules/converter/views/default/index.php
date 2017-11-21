<?php

/** @var array $currency */


use common\classes\Debug;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Конвертер валют';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Конвертер валют',
]);


$this->registerJsFile('/js/converter.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<section class="currency-converter">
    <div class="container">
        <div class="e-content">
            <h1>Конвертер валют </h1>
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
                        <li><a href="<?= Url::to(['/currency']) ?>">Валюта</a></li>
                        <li><a href="<?= Url::to(['/currency', 'type' => 'metal']) ?>">Металлы</a></li>
                        <li><a href="#">Новости</a></li>
                        <li><a href="<?= Url::to(['/currency', 'type' => 'coin']) ?>">Криптовалюта</a></li>
                        <li><a href="<?= Url::to(['/converter']) ?>">Конвертер</a></li>
                    </ul>
                </div>
            </div>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2>Конвертер валют </h2>
                </div>
                <form action="#" id="currency-converter">

                    <div class="convert-wrap">
                        <label for="convert-sum">Введите сумму</label>
                        <input type="text" name="sum" id="convert-sum">
                    </div>
                    <a href="#" class="convert-arrow">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    <div class="convert-wrap">
                        <label for="convert-result">Введите сумму</label>
                        <input type="text" name="sum" id="convert-result">
                    </div>

                    <div class="convert-wrap">
                        <label for="currency-selection">Конвертировать в</label>
                        <?= Html::dropDownList(
                            '',
                            'RUB',
                            ['RUB' => 'RUB - Российский рубль'],
                            ['id' => 'currency-selection'])
                        ?>
                    </div>
                    <a href="#" class="convert-arrow">
                        <i class="fa fa-exchange" aria-hidden="true"></i>
                    </a>
                    <div class="convert-wrap">
                        <label for="convert-to">Конвертировать в</label>
                        <?= Html::dropDownList(
                            '',
                            'USD',
                            $currency,
                            ['id' => 'convert-to'])
                        ?>
                        <!--                        <div class="check-list" id="subcat">-->
                        <!--                            <ul>-->
                        <!--                                <li>-->
                        <!--                        <span class="check-item">-->
                        <!--                            <span></span>-->
                        <!--                        </span>-->
                        <!--                                    НБУ-->
                        <!---->
                        <!---->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                        <span class="check-item">-->
                        <!--                            <span></span>-->
                        <!--                        </span>-->
                        <!--                                    Покупка-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                        <span class="check-item">-->
                        <!--                            <span></span>-->
                        <!--                        </span>-->
                        <!--                                    Продажа-->
                        <!--                                </li>-->
                        <!--                            </ul>-->
                        <!--                        </div>-->
                        <!--                        <label for="c-result"></label>-->
                        <!--                        <input type="text" name="sum" id="c-result" value="25.4589">-->
                    </div>

                </form>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <p>
                        Калькулятор курса валют – простой и удобный механизм, позволяющий выполнять моментальные
                        операции по переводу любых сумм из одних денежных единиц в другие. Конвертер валют онлайн
                        выполняет автоматический пересчет по курсу ЦБ РФ.
                    </p>
                    <p>
                        С помощью навигации по дате, конвертер валют онлайн по запросу производит расчет денежных
                        средств согласно предшествующему курсу, что позволит сравнить полученную сумму с актуальной и
                        принять решение о целесообразности той или иной денежной операции на сегодняшний день.
                    </p>
                    <p>
                        Подробнее на Рамблер/финансы... https://finance.rambler.ru/calculators/converter/
                    </p>
                </div>
            </div>
        </div>
        <!-- start promotions-sidebar-right.html-->
        <!-- end promotions-sidebar-right.html-->
    </div>
</section>
<!-- end currency-converter.html-->
