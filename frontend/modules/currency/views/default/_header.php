<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 17.11.2017
 * Time: 17:10
 */

/** @var string $title */

use common\models\db\Currency;
use yii\helpers\Url;

?>

<h1><?= $title ?></h1>
<div class="currency-menu__header">
    <div class="currency-menu__header__left">
        <ul>
            <li><a href="<?= Url::to(['/currency/default/all']) ?>">Валютный рынок</a></li>
        </ul>
    </div>
    <div class="currency-menu__header__right">
        <ul>
            <li><a href="<?= Url::to(['/currency']) ?>">Валюта</a></li>
            <li><a href="<?= Url::to(['/currency', 'type' => Currency::TYPE_COIN]) ?>">Криптовалюта</a></li>
            <li><a href="<?= Url::to(['/currency', 'type' => Currency::TYPE_METAL]) ?>">Металлы</a></li>
            <li><a href="<?= Url::to(['/currency/converter']) ?>">Конвертер</a></li>
        </ul>
    </div>
</div>

