<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 11:03
 * @var $rates \common\models\db\ExchangeRatesType
 */

?>
<?php // \common\classes\Debug::prn($rates) ?>
<div class="home-content__sidebar_exchange">
    <nav class="title__tabs">
        <ul>
            <?php foreach ($rates as $k => $rate): ?>
                <?php if (!empty($rate->exchange_rates)): ?>
                    <li>
                        <a href="#" class="page__tabs_target <?= $k === 0 ? 'page__tabs_active' : '' ?>"
                           data-tab="<?= $rate->id ?>">
                            <span><?= $rate->name ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="box-connent">
        <?php foreach ($rates as $k => $rate): ?>
            <?php if (!empty($rate->exchange_rates)): ?>
                <article class="page__tabcontent <?= $k === 0 ? 'page__tabcontent_active' : '' ?> <?= $rate->id ?>">
                    <table>
                        <thead>
                        <tr>
                            <th>Валюта</th>
                            <th>Покупка</th>
                            <th>Продажа</th>
                        </tr>
                        </thead>
                        <tbode>
                            <?php foreach ((array)$rate->exchange_rates as $exchange_rate): ?>
                                <tr>
                                    <td><?= $exchange_rate->currencies ?></td>
                                    <td><?= $exchange_rate->buy ?></td>
                                    <td><?= $exchange_rate->sale ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbode>
                    </table>
                    <a href="" class="show-more">подробнее<span class="red-arrow"></span></a>
                </article>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
